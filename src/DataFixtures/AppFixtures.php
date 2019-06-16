<?php

namespace App\DataFixtures;

use App\Entity\Restaurant;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $restaurant = new Restaurant();
        $restaurant
            ->setTitle('Užkandinė Avilys')
            ->setActive(true);


        $user = new User();
        $user->setName('Aurimas Vilys')
            ->setEmail('aurimas@vilys.lt')
            ->setRoles(['ROLE_USER'])
            ->setPassword(
                $this->passwordEncoder->encodePassword($user, 'aurimas')
            );

        $manager->persist($user);
        $manager->persist($restaurant);
        $manager->flush();
    }
}
