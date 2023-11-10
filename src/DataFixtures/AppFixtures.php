<?php

namespace App\DataFixtures;

use App\Entity\Address;
use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\InfoUser;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // proriété pour encoder le mot de passe
    private $encoder;
    // propriété pour le faker
    private Generator $faker;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
        // ici on va appeler toutes nos fonctions load
        // fonction loadAddress
        $this->loadAddress($manager);

        $manager->flush();
    }

    // méthode qui alimente Address
    public function loadAddress(ObjectManager $manager)
    {
        for ($i = 1; $i <= 4; $i++) {
            $address = new Address();
            $address->setAddress0($this->faker->streetAddress);
            $address->setAddress1($this->faker->streetAddress);
            $address->setAddress2($this->faker->streetAddress);
            $address->setZipCode($this->faker->postcode);
            $address->setCity($this->faker->city);
            $address->setCountry($this->faker->country);
            $manager->persist($address);
            $this->addReference('address_' . $i, $address);
        }
    }









    // // méthode qui alimente InfoUser
    // public function loadInfoUser(ObjectManager $manager)
    // {
    //     for ($i = 1; $i <= 4; $i++) {
    //         $infoUser = new InfoUser();
    //         $infoUser->setName($this->faker->lastName);
    //         $infoUser->setFirstname($this->faker->firstName);
    //         $infoUser->setPhone($this->faker->phoneNumber);
    //         $infoUser->setBirthDate($this->faker->dateTimeBetween($startDate = '-100 years', $endDate = '-6 years', $timezone = null));
    //         $manager->persist($infoUser);
    //         $this->addReference('infoUser_' . $i, $infoUser);
    //     }
    // }

    // // méthode qui alimente User
    // public function loadUser(ObjectManager $manager)
    // {
    //     // on créé un admin
    //     $user = new User();
    //     $user->setEmail('admin@admin.com')
    //         ->setPassword($this->encoder->hashPassword($user, 'admin'))
    //         ->setRoles(['ROLE_ADMIN'])
    //         ->setInfoUser($this->getReference('infoUser_1'));
    //     $manager->persist($user);
    //     $this->addReference('user_1', $user);

    //     // on créé les 3 clients (références de 2 à 4)
    //     for ($i = 2; $i <= 4; $i++) {
    //         $user = new User();
    //         $user->setEmail($this->faker->email);
    //         $user->setPassword($this->encoder->hashPassword($user, 'prof'));
    //         $user->setRoles(['ROLE_CLIENT']);
    //         $user->setInfoUser($this->getReference('infoUser_' . $i));
    //         $manager->persist($user);
    //         $this->addReference('user_' . $i, $user);
    //     }
    // }
}
