<?php

namespace App\Controller;


use App\Entity\Lieu;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LieuController extends AbstractController
{
    #[Route('/lieu', name: 'app_lieu')]
    public function index(EntityManagerInterface $entityManager): Response
    {

           // Récupérer tous les lieux depuis la base de données
         
           $lieux = $entityManager->getRepository(Lieu::class)->findAll();


        return $this->render('lieu/index.html.twig', [
            'lieux' => $lieux,
        ]);
    }

    #[Route('/lieu/{id}', name: 'lieu_show')]
public function show(Lieu $lieu): Response
{
    return $this->render('lieu/show.html.twig', [
        'lieu' => $lieu,
    ]);
}

}
