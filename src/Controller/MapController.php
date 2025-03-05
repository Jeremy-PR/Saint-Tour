<?php

namespace App\Controller;

use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MapController extends AbstractController
{
    #[Route('/map', name: 'app_map')]
    public function index(LieuRepository $lieuRepository, NormalizerInterface $normalizer): Response
    {
        $lieux = $lieuRepository->findAll();
        $lieuxNormalized = $normalizer->normalize($lieux, null, ['groups' => 'lieu:read']);
        return $this->render('map/index.html.twig', [
            'lieux' => json_encode($lieuxNormalized),
            'controller_name' => 'TestFetchJavascriptController',
        ]);
    }
}
