<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ItineraireController extends AbstractController
{
    #[Route('/itineraire', name: 'app_itineraire')]
    public function index(): Response
    {
        return $this->render('itineraire/itineraire.html.twig', [
            'controller_name' => 'ItineraireController',
        ]);
    }
}
