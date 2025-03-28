<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Itineraire;
use App\Entity\Lieu;
use App\Form\AvisType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function show(Itineraire $itineraire, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Récupérer les lieux associés à l'itinéraire
        $lieux = $itineraire->getLieux();
    
        // Préparer les données des lieux pour le JavaScript
        $lieuxData = [];
        foreach ($lieux as $lieu) {
            $lieuxData[] = [
                'id' => $lieu->getId(),
                'name' => $lieu->getName(),
                'latitude' => $lieu->getLatitude(),
                'longitude' => $lieu->getLongitude(),
            ];
        }
    
        // Créer un nouvel avis
        $avis = new Avis();
        $avis->setItineraire($itineraire);
        $avis->setUser($this->getUser());
        $avis->setCreatedAt(new \DateTimeImmutable());
    
        // Créer le formulaire
        $form = $this->createForm(AvisType::class, $avis);
        $form->handleRequest($request);
    
        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avis);
            $entityManager->flush();
    
            $this->addFlash('success', 'Votre avis a été ajouté avec succès.');
    
            return $this->redirectToRoute('itineraire_show', ['id' => $itineraire->getId()]);
        }
    
        // Rendre le template avec les données nécessaires
        return $this->render('itineraire/show.html.twig', [
            'itineraire' => $itineraire,
            'lieuxData' => $lieuxData, // Transmettre les données des lieux
            'form' => $form->createView(), // Transmettre le formulaire
        ]);
    }}