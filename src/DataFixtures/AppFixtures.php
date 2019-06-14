<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $restaurant = new Restaurant();
        $restaurant
            ->setTitle('Užkandinė Avilys')
            ->setActive(true);

        $manager->persist($restaurant);
        $manager->flush();
    }
}
