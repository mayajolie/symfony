<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ServiceFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $service = new Services();
        $service->setService($_POST['libelle']);
         $manager->persist($service);

        $manager->flush();
    }
}
