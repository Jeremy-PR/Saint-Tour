<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\LieuRepository;
use App\Repository\ItineraireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function afficherCarte(LieuRepository $lieuRepository, CategorieRepository $categorieRepository, ItineraireRepository $itineraireRepository, NormalizerInterface $normalizer): Response
    {
        // Récupération des lieux et normalisation des données
        $lieux = $lieuRepository->findAll();
        $lieuxNormalized = $normalizer->normalize($lieux, null, ['groups' => 'lieu:read']);

        // Récupération des itinéraires pour afficher les points correspondants
        $itineraires = $itineraireRepository->findAllWithLieux();

        // dd($itinéraires);
        $itinerairesNormalized = $normalizer->normalize($itineraires, null, ['groups' => 'itineraire:read']);
        
        $categories = $categorieRepository->findAll();

        return $this->render('map/index.html.twig', [
            'lieux' => json_encode($lieuxNormalized),  // Envoi des lieux au format JSON pour JavaScript
            'itineraires' => $itineraires,  // Envoi des itinéraires sous forme d'objet pour Twig
            'itinerairesJson' => json_encode($itinerairesNormalized),  // Envoi des itinéraires au format JSON pour JavaScript
            'categories' => $categories,  // Envoi des catégories pour le filtre des lieux
        ]);
    }
}
