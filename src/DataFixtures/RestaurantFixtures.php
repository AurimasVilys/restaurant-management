<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class RestaurantFixtures extends AbstractFixture implements ORMFixtureInterface
{
    public const RESTAURANT_FIXTURE_NAME = 'restaurant';
    public function load(ObjectManager $manager)
    {
        foreach ($this->getRestaurants() as $index => $restaurantData) {
            $restaurant = $this->createRestaurant($restaurantData);
            $this->addReference(self::RESTAURANT_FIXTURE_NAME . '-' . $index, $restaurant);
            $manager->persist($restaurant);
        }
        $manager->flush();
    }

    private function createRestaurant(array $data)
    {
        $restaurant = new Restaurant();
        $restaurant
            ->setTitle($data['title'])
            ->setActive($data['active']);
        if ($data['photo']) {
            $uploadedFile = new UploadedFile(
                $data['photo'],
                $data['photo'],
                'image/*',
                null,
                true
            );
            $restaurant->setUploadedPhoto($uploadedFile);
        }
        return $restaurant;
    }

    private function getRestaurants()
    {
        return
            [
                [
                    'title' => 'CafeBistro',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/1.jpg'
                ],
                [
                    'title' => 'Cafe 123',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/6.jpg'
                ],
                [
                    'title' => 'Pizza Hut',
                    'active' => 0,
                    'photo' => 'src/DataFixtures/Images/8.png'
                ],
                [
                    'title' => 'Mill House',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/2.jpg'
                ],
                [
                    'title' => 'Steak house',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/7.jpg'
                ],
                [
                    'title' => 'Fast Lunch',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/3.jpg'
                ],
                [
                    'title' => 'Grill house',
                    'active' => 0,
                    'photo' => ''
                ],
                [
                    'title' => 'Beetroot',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/5.jpg'
                ],
                [
                    'title' => 'Old bakery',
                    'active' => 1,
                    'photo' => 'src/DataFixtures/Images/4.jpg'
                ],
                [
                    'title' => 'Coffee time',
                    'active' => 0,
                    'photo' => ''
                ],
            ];
    }
}