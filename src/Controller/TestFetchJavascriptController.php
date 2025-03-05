<?php

namespace App\Controller;

use App\Repository\LieuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class TestFetchJavascriptController extends AbstractController
{
    #[Route('/test/fetch/javascript', name: 'app_test_fetch_javascript')]
    public function index(LieuRepository $lieuRepository, NormalizerInterface $normalizer): Response
    {
        $lieux = $lieuRepository->findAll();
        $lieuxNormalized = $normalizer->normalize($lieux, null, ['groups' => 'lieu:read']);
        // dd($lieux);

        return $this->render('test_fetch_javascript/index.html.twig', [
            'lieux' => json_encode($lieuxNormalized),
            'controller_name' => 'TestFetchJavascriptController',
        ]);
    }

    // #[Route('/test/fetch/lieu', name: 'app_test_fetch_lieu', methods: ['GET'])]
    // public function lieux(LieuRepository $lieuRepository): JsonResponse
    // {
    //     return $this->json($lieuRepository->findAll(), 200, [], ['groups' => 'lieu:read']);
    // }
}
