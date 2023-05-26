<?php

namespace App\Controller;

use App\Entity\Annonces;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AnnoncesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\HttpFoundation\Request;




class ApiAchatAnnonceController extends AbstractController
{
    /**
     * @Route("/api/achatAnnonce", name="app_api_achat_annonce", methods={"POST"})
     */
    public function index(EntityManagerInterface $entityManager, AnnoncesRepository $aR, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $idAcheteur = $data['idAch'];
        $annonceId = $data['idAnn'];


        $annonce = $aR->findOneBy(['id' => $annonceId]);

        if (!$annonce) {
            return new JsonResponse(['message' => 'Annonce non trouvée'], 200);
        }
    
        // Mettre à jour le champ idAcheteur
        $annonce->setAcheteurID($idAcheteur);
    
        // Enregistrer les modifications dans la base de données
        $entityManager->flush();
    
        return new JsonResponse(['message' => 'Champ idAcheteur mis à jour avec succès'], 200);
    }
}
