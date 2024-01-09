<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\SupplierFactory;

class SupplierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SupplierFactory::createMany(5);

        $manager->flush();
    }
}
