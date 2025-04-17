<?php

namespace App\Controller;


use App\Entity\Lieu;
use App\Repository\LieuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LieuController extends AbstractController
{
    #[Route('/lieu', name: 'app_lieu')]
    public function index(LieuRepository $lieuRepository): Response
    {
        $lieux = $lieuRepository->findAll();

        return $this->render('lieu/all_lieux.html.twig', [
            'lieux' => $lieux,
        ]);
    }

    #[Route('/lieu/{id}', name: 'lieu_show')]
    public function show(Lieu $lieu, Request $request): Response
    {
        $referer = $request->headers->get('referer'); // Récupérer l'URL de la page précédente
    
        return $this->render('lieu/show.html.twig', [
            'lieu' => $lieu,
            'referer' => $referer, // Passer le referer à la vue
        ]);
    }
}
