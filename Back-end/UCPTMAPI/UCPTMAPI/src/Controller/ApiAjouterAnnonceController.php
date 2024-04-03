<?php

namespace App\Controller;

use App\Entity\Annonces;
use App\Entity\Utilisateurs;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\KernelInterface;

class ApiAjouterAnnonceController extends AbstractController
{
    /**
     * @Route("/api/ajouterAnnonce", name="app_api_ajouter_annonce", methods={"POST"})
     */
    public function index(KernelInterface $kernel, EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $nom = $request->request->get('nom');
        $description = $request->request->get('description');
        $prix = $request->request->get('prix');
        $idUti = $request->request->get('idUti');
        $photo = $request->files->get('photo');

        $destinationFolder = '\uploads\\';

        $newFilename = $nom.'.'.$photo->getClientOriginalExtension();
        $photo->move($destinationFolder, $newFilename);

        $destinationPath = $destinationFolder.$newFilename;

        $utilisateur = $entityManager->getRepository(Utilisateurs::class)->find($idUti);

        $annonce = new Annonces();
        $annonce->setNom($nom)
                ->setDescription($description)
                ->setPrix($prix)
                ->setUtilisateurId($idUti)
                ->setPhoto($destinationPath)
                ->setVendeur($utilisateur);

        $entityManager->persist($annonce);
        $entityManager->flush();

        return new JsonResponse(['annonce' => true], 200);
    }
}
