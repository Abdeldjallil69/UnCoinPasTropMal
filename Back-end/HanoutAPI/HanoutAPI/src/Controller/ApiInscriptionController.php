<?php

namespace App\Controller;

use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiInscriptionController extends AbstractController
{
    /**
     * @Route("/api/inscription", name="app_api_inscription", methods={"POST"})
     */
    public function index(EntityManagerInterface $entityManager, utilisateursRepository $uR, Request $request, SerializerInterface $sI): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['email'];
        
        $userByEmail = $uR->findOneBy(['email' => $email]);

        if ($userByEmail == null) { // Il n'y a pas cette adresse dans la bdd => inscro
            $pseudo = $data['pseudo'];
            $password = $data['password'];

            $utilisateur = new Utilisateurs();
            $utilisateur->setPseudo($pseudo);
            $utilisateur->setEmail($email);
            $utilisateur->setPassword($password);
            $utilisateur->setDateCreation(new \DateTimeImmutable());

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            $idNouvelUtilisateur = $uR->findUserIdByEmail($email);
            

            return new JsonResponse(['inscription' => true, 'idUti' => $idNouvelUtilisateur], 200);
        } else {
            return new JsonResponse(['inscription' => false, ], 200);
        }
    }
}
