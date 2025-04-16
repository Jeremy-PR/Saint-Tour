<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Itineraire;
use App\Form\AvisType;
use App\Repository\ItineraireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ItineraireController extends AbstractController
{
    #[Route('/itineraire', name: 'app_itineraire')]
    public function index(ItineraireRepository $itineraireRepository): Response
    {
        $itineraires = $itineraireRepository->findAll();
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
        // $avis->setCreatedAt(new \DateTimeImmutable()); // Optionnel, car déjà défini dans le constructeur

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
    }

    #[Route('/avis/{id}/delete', name: 'avis_delete', methods: ['POST'])]
    public function deleteAvis(Request $request, Avis $avis, EntityManagerInterface $entityManager): Response
    {
        // Vérifiez que l'utilisateur connecté est le propriétaire du commentaire
        if ($avis->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez pas supprimer ce commentaire.');
        }

        // Vérifiez le token CSRF
        if ($this->isCsrfTokenValid('delete' . $avis->getId(), $request->request->get('_token'))) {
            $entityManager->remove($avis);
            $entityManager->flush();

            $this->addFlash('success', 'Votre commentaire a été supprimé avec succès.');
        }

        return $this->redirectToRoute('itineraire_show', ['id' => $avis->getItineraire()->getId()]);
    }
}
