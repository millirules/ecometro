<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Factory\EnvirometalMetricFactory;

class EnviromentalMetricFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        EnvirometalMetricFactory::createMany(5);

        $manager->flush();
    }
}
