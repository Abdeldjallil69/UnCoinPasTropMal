<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;

class ApiProfilController extends AbstractController
{
    /**
     * @Route("/api/majProfil", name="app_api_profil", methods={"POST"})
     */
    public function index(EntityManagerInterface $entityManager, utilisateursRepository $uR, Request $request, SerializerInterface $sI): JsonResponse
    {
        $idUti = $request->request->get('idUti');

        if ($request->request->has('pseudo') && $request->request->has('password')) {
            $newPseudo = $request->request->get('pseudo');
            $newPassword = $request->request->get('password');

            $utilisateur = $uR->findUserById($idUti);

            $utilisateur->setPassword($newPassword)->setPseudo($newPseudo);

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return new JsonResponse(['miseAjour pseudo et password' => true, ], 200);
        } else if ($request->request->has('password')) {
            $newPassword = $request->request->get('password');

            $utilisateur = $uR->findUserById($idUti);

            $utilisateur->setPassword($newPassword);

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return new JsonResponse(['miseAjour password' => true, ], 200);
        } else if ($request->request->has('pseudo')) {
            $newPseudo = $request->request->get('pseudo');

            $utilisateur = $uR->findUserById($idUti);

            $utilisateur->setPseudo($newPseudo);

            $entityManager->persist($utilisateur);
            $entityManager->flush();

            return new JsonResponse(['miseAjour pseudo' => true, ], 200);
        }
    }
}
