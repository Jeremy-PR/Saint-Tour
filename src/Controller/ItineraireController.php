<?php

namespace App\Controller;

use App\Entity\Itineraire;
use App\Entity\Lieu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ItineraireController extends AbstractController
{
    #[Route('/itineraire', name: 'app_itineraire')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $itineraires = $entityManager->getRepository(Itineraire::class)->findAll();
        return $this->render('itineraire/all_itineraires.html.twig', [
            'itineraires' => $itineraires,
        ]);
    }

    #[Route('/itineraire/{id}', name: 'itineraire_show')]
public function show(Itineraire $itineraire, EntityManagerInterface $entityManager): Response
{
    $lieux = $itineraire->getLieux();
    return $this->render('itineraire/show.html.twig', [
        'itineraire' => $itineraire,
        'lieux' => $lieux,
    ]);
}
}
