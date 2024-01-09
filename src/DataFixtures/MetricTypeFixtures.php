<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\MetricTypeFactory;

class MetricTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        MetricTypeFactory::createMany(5);

        $manager->flush();
    }
}
