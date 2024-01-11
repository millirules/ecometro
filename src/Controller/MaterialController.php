<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\MaterialRepository;
use App\Entity\Material;
use App\Repository\EnvirometalMetricRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\MaterialTypeRepository;
use App\Repository\SupplierRepository;
use Symfony\Component\Cache\Exception\InvalidArgumentException;
use Exception;


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
    public function materials(MaterialRepository $materialRepository, Request $request): JsonResponse
    {
        $materials = $materialRepository->findAll();
        //$request->query->get('filtro');
        $materials = $materialRepository->findByNameField($request->query->get('name'));

        return $this->json($materials);
    }

    #[Route('/material/{id}', name: 'get_material', methods: ["GET"])]
    public function centro(Material $material): JsonResponse
    {
        return $this->json($material);
    }
    /**
     * TODO: Hay que cambiar el value de enviromental metric a la tabla pivote
     */

    #[Route("/materials", "create_material", methods: ["POST"])]
    public function createCentro(Request $request, ValidatorInterface $validator,
                                MaterialRepository $materialRepository, MaterialTypeRepository $materialTypeRepository,
                                SupplierRepository $supplierRepository, EnvirometalMetricRepository $envirometalMetricRepository): JsonResponse
    {
        
        try {
            $requestBody = json_decode($request->getContent(), true);
        
            $material = new Material();
            $material->setName($requestBody["name"]);
            $material->setCost($requestBody["cost"]);
            if (isset($requestBody['material_type_id'])) {
                $materialType = $materialTypeRepository->findOneById($requestBody["material_type_id"]);
                $material->setMaterialType($materialType);
            }
            if (isset($requestBody['supplier_id'])) {
                $supplier = $supplierRepository->findOneById($requestBody["supplier_id"]);
                $material->addSupplier($supplier);
            }
            /* if (isset($requestBody['metric_id'])) {
                $metric = $envirometalMetricRepository->findOneById($requestBody['metric_id']);
                $material->addMaterialEnviromentalMetric($metric);
            } */
            
            $errors = [];
            $errors = $validator->validate($material);
            
            if (count($errors) > 0) {
                throw new InvalidArgumentException((string) $errors);
            }
            $materialRepository->save($material, true);

            return $this->json($material, status: Response::HTTP_CREATED);
        } catch(Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
        
    #[Route("/material/{id}", "delete_material", methods: ["DELETE"])]
    public function deleteCentro(Material $material, MaterialRepository $materialRepository): JsonResponse
    {
        try {
            $materialRepository->remove($material, true);

            return $this->json("elemento eliminado", Response::HTTP_NO_CONTENT);
        } catch(Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }

    #[Route("/materials/{id}", "update_material", methods: ["PATCH", "PUT"])]
    public function updateMaterial(Material $material, Request $request, ValidatorInterface $validator, 
                                MaterialRepository $materialRepository, MaterialTypeRepository $materialTypeRepository,
                                SupplierRepository $supplierRepository, EnvirometalMetricRepository $envirometalMetricRepository
                                ): JsonResponse
    {
        try {
            $requestBody = json_decode($request->getContent(), true);

            foreach($requestBody as $field => $value) {
                switch($field) {
                    case "name":
                        $material->setName($value);
                        break;
                    case "cost":
                        $material->setCost($value);
                        break;
                    case "material_type_id":
                        $materialType = $materialTypeRepository->findOneById($value);
                        $material->setMaterialType($materialType);
                        break;
                    case "supplier_id":
                        $supplier = $supplierRepository->findOneById($value);
                        $material->addSupplier($supplier);
                        break;
                    case "metric_id":
                        $metric = $envirometalMetricRepository->findOneById($value);
                        $material->addMaterialEnviromentalMetric($metric);
                }
            }

            $errors = $validator->validate($material);
            if (count($errors) > 0) {
                throw new InvalidArgumentException((string) $errors);
            }

            $materialRepository->update($material);

            return $this->json($material);

        } catch(Exception $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
    }
}

