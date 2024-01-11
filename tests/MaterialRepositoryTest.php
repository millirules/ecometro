<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use App\Entity\Material;
use DateTimeImmutable;

class MaterialRepositoryTest extends KernelTestCase
{
    private EntityManager $em;
    private ValidatorInterface  $validator;

    protected function setUp(): void
    {
        $this->em = self::getContainer()->get('doctrine')->getManager();
        $this->validator = self::getContainer()->get("validator");
    }

    public function testDefaultValues(): void
    {
        $material = new Material();

        // Test default values
        $this->assertNull($material->getId());
        $this->assertNull($material->getName());
        $this->assertNull($material->getCost());
        $this->assertNull($material->getCreatedAt());
        $this->assertNull($material->getUpdatedAt());
    }
    
    public function testName()
    {
        $material = new Material();
        
        $errors = $this->validator->validateProperty($material, "name");
        foreach($errors as $error) {
            $this->assertInstanceOf(NotBlank::class, $errors[0]->getConstraint());
        }
        

        $material->setName("Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas");
        /** @var ConstraintViolation[] $errors */
        $errors = $this->validator->validateProperty($material, "name");
        foreach($errors as $error) {
            $this->assertInstanceOf(Length::class, $error[0]->getConstraint());
        }
        
        $name = 'Test Material';
        $material->setName($name);
        $this->assertEquals($name, $material->getName());

    }

    public function testCost()
    {
        $material = new Material();
        
        $cost = 33;
        $material->setCost($cost);
        $this->assertEquals($cost, $material->getCost());
    }

    public function testDoctrineEvents()
    {
        $material = new Material();

        // Persist the entity (not flush) in order to generate the createdAt and updatedAt fields
        $this->em->persist($material);

        // Test the createdAt and updatedAt setter and getter methods
        $this->assertInstanceOf(DateTimeImmutable::class, $material->getCreatedAt());
        $this->assertInstanceOf(DateTimeImmutable::class, $material->getUpdatedAt());

        // Detch the entity to prevent tracking unused entity
        $this->em->detach($material);
    }
}
 