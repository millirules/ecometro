<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\MaterialTypeFactory;

class MaterialTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MaterialTypeFactory::createMany(5);

        $manager->flush();
    }
}
