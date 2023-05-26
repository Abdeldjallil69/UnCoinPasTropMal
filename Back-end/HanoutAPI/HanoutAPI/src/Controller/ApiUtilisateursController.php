<?php

namespace App\Controller;

use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\UtilisateursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ApiUtilisateursController extends AbstractController
{
    /**
     * @Route("/api/utilisateurs", name="app_api_utilisateurs", methods={"GET"})
     */
    public function index(UtilisateursRepository $utilRepository, SerializerInterface $serializer): JsonResponse
    {
        $utilisateurs = $utilRepository->findAll();
        $serializedUtilisateurs = $serializer->serialize($utilisateurs, 'json', ['groups' => 'utilisateurs:read']);

        return new JsonResponse($serializedUtilisateurs, 200, [], true);
    }
}
