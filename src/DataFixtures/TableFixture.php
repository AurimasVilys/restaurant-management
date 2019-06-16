<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Entity\Table;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TableFixture extends AbstractFixture implements ORMFixtureInterface, DependentFixtureInterface
{
    public function getDependencies()
    {
        return [RestaurantFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $counter = 0;
        while (true) {
            $referenceKey = RestaurantFixtures::RESTAURANT_FIXTURE_NAME . '-' . $counter;

            if (!$this->hasReference($referenceKey)) {
                break;
            }

            $tables = rand(5, 30);
            for ($i = 1; $i <= $tables; $i++) {
                $table = $this->createTable(
                    [
                        'restaurant' => $referenceKey,
                        'number' => $i,
                        'capacity' => rand(1, 10),
                        'active' => rand(0, 1)
                    ]
                );
                $manager->persist($table);
            }
            $counter++;
        }
        $manager->flush();
    }

    private function createTable($data)
    {
        $table = new Table();
        /** @var Restaurant $restaurant */
        $restaurant = $this->getReference($data['restaurant']);
        $table->setRestaurant($restaurant)
            ->setNumber($data['number'])
            ->setCapacity($data['capacity'])
            ->setActive($data['active']);
        return $table;
    }
}