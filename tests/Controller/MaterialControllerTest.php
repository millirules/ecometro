<?php

namespace App\Tests\Controller;

use App\Entity\Material;
use App\Entity\MaterialType;
use App\Repository\MaterialRepository;
use App\Repository\MaterialTypeRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class MaterialControllerTest extends WebTestCase
{
    private MaterialRepository $materialRepository;
    private MaterialTypeRepository $materialTypeRepository;
    private KernelBrowser $client;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $entityManager = self::getContainer()->get('doctrine')->getManager();
        $this->materialRepository = $entityManager->getRepository(Material::class);
        $this->materialTypeRepository = $entityManager->getRepository(MaterialType::class);
    }

    private function testMaterialFormat(array $materialAsArray): void
    {
        $materialKeys = ["id", "name", "cost", "createdAt", "updatedAt"];
        foreach ($materialKeys as $key) {
            $this->assertArrayHasKey($key, $materialAsArray);
        }
    }

    public function testGetMaterials(): void
    {
        // Make a request with default page parameter
        $this->client->request('GET', '/api/materials');

        // Check if the request is valid
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertResponseFormatSame("json");
    }

    public function testGetOneMaterial(): void
    {
        $material = $this->materialRepository->findOneBy([]);
    
        $this->client->request('GET', '/api/material/' . $material->getId());
        
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);
        $this->assertResponseFormatSame("json");

        $response = $this->client->getResponse();
        $result = json_decode($response->getContent(), true);
        $this->testMaterialFormat($result);
    }

    public function testNotFoundMaterial(): void
    {
        $this->client->request('GET', '/api/material/12222');
        $this->client->getResponse();
        $this->assertResponseStatusCodeSame(Response::HTTP_NOT_FOUND);
        $this->assertResponseStatusCodeSame('404');
    }

    public function testCreateMaterial(): void
    {
        $materialType = $this->materialTypeRepository->findOneBy([]);
        // Make the request with body paramater without the "X-AUTH-TOKEN" header to chech the security
        $this->client->request('POST', "/api/materials", content: json_encode(["name" => "Un Material de Test", "cost" => 25, "material_type_id" => $materialType->getId()]));

      
        // Check if the response if successful
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_CREATED);

        // Check the response format
        $response = $this->client->getResponse();
        $result = json_decode($response->getContent(), true);
        $this->testMaterialFormat($result);

        $this->assertSame("Un Material de Test", $result["name"]);
    }
    
    public function testDeleteMaterial(): void
    {
        // As for the previous method, we first make the request without the token header
        $material = $this->materialRepository->findOneBy([]);
        $this->client->request('DELETE', "/api/material/" . $material->getId());

        // Check if the request is successful
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_NO_CONTENT);
    }

    public function testUpdateMaterial(): void
    {
        $material = $this->materialRepository->findOneBy([]);
        $this->client->request('PATCH', "/api/materials/" . $material->getId(), content: json_encode(["name" => "Un Material de Test Modificado", "cost" => 25.45]));

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $response = $this->client->getResponse();
        $result = json_decode($response->getContent(), true);
        $this->testMaterialFormat($result);

        $this->assertSame("Un Material de Test Modificado", $result["name"]);
    }
   

}
