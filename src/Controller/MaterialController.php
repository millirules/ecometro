<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterialRepository;

class MaterialController extends AbstractController
{
    #[Route('/material', name: 'app_material')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/MaterialController.php',
        ]);
    }

    #[Route('/materials', name: 'app_materials', methods: ["GET"])]
    public function materials(MaterialRepository $materialRepository): JsonResponse
    {
        $materials = $materialRepository->findAll();

        return $this->json($materials);
    }
}
