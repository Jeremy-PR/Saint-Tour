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
    public function afficherCarte(
        LieuRepository $lieuRepository,
        CategorieRepository $categorieRepository,
        ItineraireRepository $itineraireRepository,
        NormalizerInterface $normalizer
    ): Response {
        // Récupération des lieux et normalisation des données
        $lieux = $lieuRepository->findAll();
        $lieuxNormalized = $normalizer->normalize($lieux, null, ['groups' => 'lieu:read']);
    
        // Récupération des itinéraires et normalisation
        $itineraires = $itineraireRepository->findAll();
        $itinerairesNormalized = array_map(function ($itineraire) {
            return [
                'id' => $itineraire->getId(),
                'name' => $itineraire->getName(),
                'lieux' => array_map(fn($lieu) => $lieu->getId(), $itineraire->getLieux()->toArray()),
                // 'coordinates' => $itineraire->getCoordinates() ?? [], // Si applicable
            ];
        }, $itineraires);
    
        // Récupération des catégories
        $categories = $categorieRepository->findAll();
    
        return $this->render('map/index.html.twig', [
            'lieux' => json_encode($lieuxNormalized),  // Envoi des lieux au format JSON pour JavaScript
            'itineraires' => $itinerairesNormalized,  // Envoi des itinéraires normalisés pour JavaScript
            'categories' => $categories,  // Envoi des catégories pour le filtre des lieux
        ]);
    }}
