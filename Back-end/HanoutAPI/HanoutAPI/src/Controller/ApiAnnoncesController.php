<?php

namespace App\Controller;

use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\AnnoncesRepository;
use App\Entity\Annonces;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ApiAnnoncesController extends AbstractController
{
    /**
     * @Route("/api/annonces", name="app_api_annonces_get", methods={"GET"})
     */
    public function indexGet(AnnoncesRepository $aR, SerializerInterface $serializer): JsonResponse
    {
        $annonces = $aR->findAll();

        $serializedAnnonces = $serializer->serialize($annonces, 'json', ['groups' => 'annonces:read']);

        return new JsonResponse($serializedAnnonces, 200, [], true);
    }

    /**
     * @Route("/api/annonces", name="app_api_annonces_post", methods={"POST"})
     */
    public function indexPost(AnnoncesRepository $aR, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $idUti = $data['idUti'];


        $annonces = $aR->findBy(['utilisateurId' => $idUti]);

        $serializedAnnonces = $serializer->serialize($annonces, 'json', ['groups' => 'annonces:read']);

        return new JsonResponse($serializedAnnonces, 200, [], true);
    }

    /**
     * @Route("/api/annonces/modifier", name="app_api_annonces_modifier", methods={"POST"})
     */
    public function indexPostMaj(AnnoncesRepository $aR, SerializerInterface $serializer, Request $request): JsonResponse
    {
        $idAnnonce = $request->request->get('idAnnonce');

        if ($request->request->has('prix') && $request->request->has('description')) {
            $newPrix = $request->request->get('prix');
            $newDescription = $request->request->get('description');

            $annonce = $aR->findOneBy(['id' => $idAnnonce]);

            $annonce->setDescription($newDescription)
                    ->setPrix($newPrix);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return new JsonResponse(['miseAjour Prix et Description' => true, 'annonceId' => $idAnnonce ], 200);
        } else if ($request->request->has('prix')) {
            $newPrix = $request->request->get('prix');

            $annonce = $aR->findOneBy(['id' => $idAnnonce]);

            $annonce->setPrix($newPrix);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return new JsonResponse(['miseAjour Prix' => true, 'annonceId' => $idAnnonce ], 200);
        } else if ($request->request->has('description')) {
            $newDescription = $request->request->get('description');

            $annonce = $aR->findOneBy(['id' => $idAnnonce]);

            $annonce->setDescription($newDescription);

            $entityManager->persist($annonce);
            $entityManager->flush();

            return new JsonResponse(['miseAjour Description' => true, 'annonceId' => $idAnnonce ], 200);
        }
    }
}
