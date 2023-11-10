<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Stage;
use App\Entity\Address;
use App\Entity\Product;
use App\Entity\InfoUser;
use App\Entity\Facturation;
use App\Entity\Reservation;
use DateTime;
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
        // fonction loadFacturation
        $this->loadFacturation($manager);
        // fonction loadProduct
        $this->loadProduct($manager);
        // fonction loadInfoUser
        $this->loadInfoUser($manager);
        // fonction loadUser
        $this->loadUser($manager);
        // fonction loadStage
        $this->loadStage($manager);
        // fonction loadReservation
        $this->loadReservation($manager);

        // on flush pour envoyer vers la BDD avec le d:f:l
        $manager->flush();
    }

    // méthode random pour boolean
    function randomBoolean()
    {
        $randomNumber = rand(0, 1);
        return $randomNumber === 1;
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

    // méthode qui alimente Facturation
    public function loadFacturation(ObjectManager $manager)
    {
        for ($i = 1; $i <= 4; $i++) {
            $facturation = new Facturation();
            $facturation->setIsPayed($this->randomBoolean());
            $facturation->setDateStart($this->faker->dateTimeBetween($dateStart = '-10 years', $DateEnd = '-1 month'));
            $facturation->setDateEnd($this->faker->dateTimeBetween($dateStart = '-10 years', $DateEnd = 'now'));
            $facturation->setNbPeople($this->faker->numberBetween($min = 1, $max = 6));
            $facturation->setAddress($this->faker->streetAddress);
            $facturation->setZipCode($this->faker->postcode);
            $facturation->setCity($this->faker->city);
            $facturation->setCountry($this->faker->country);
            $facturation->setPriceTotal($this->faker->numberBetween($min = 9, $max = 900));

            $manager->persist($facturation);
            $this->addReference('facuration_' . $i, $facturation);
        }
    }

    // méthode qui alimente Product
    public function loadProduct(ObjectManager $manager)
    {
        $productArray = [
            ['key' => 1, 'label' => 'Drapeau', 'imagePath' => 'flag.jpg', 'description' => 'Voici le drapeau de notre club. N\'hésitez pas à l\'amener avec vous sur vos évènemets sportifs et le prendre avec vous sur vos futurs podiums !', 'price' => 9],
            ['key' => 2, 'label' => 'T-shirt', 'imagePath' => 't-shirt-spartacademy.png', 'description' => 'Tenue officielle Spartacademy, T-shirt disponible dans les tailles XS, S, M, L et XL. Nous avons une coupe pour les hommes ainsi qu\'une coupe pour les femmes', 'price' => 19],
        ];

        foreach ($productArray as $value) {
            $product = new Product();
            $product->setLabel($value['label']);
            $product->setImagePath($value['imagePath']);
            $product->setDescription($value['description']);
            $product->setPrice($value['price']);

            $manager->persist($product);
            $this->addReference('product_' . $value['key'], $product);
        }
    }

    // méthode qui alimente InfoUser
    public function loadInfoUser(ObjectManager $manager)
    {
        for ($i = 1; $i <= 4; $i++) {
            $infoUser = new InfoUser();
            $infoUser->setAddress($this->getReference('address_' . $i));
            $infoUser->setName($this->faker->lastName);
            $infoUser->setFirstname($this->faker->firstName);
            $infoUser->setPhone($this->faker->phoneNumber);
            $infoUser->setBirthDate($this->faker->dateTimeBetween($startDate = '-100 years', $endDate = '-6 years', $timezone = null));

            $manager->persist($infoUser);
            $this->addReference('infoUser_' . $i, $infoUser);
        }
    }

    // méthode qui alimente User
    public function loadUser(ObjectManager $manager)
    {
        // on créé un admin
        $user = new User();
        $user->setEmail('admin@admin.com')
            ->setPassword($this->encoder->hashPassword($user, 'admin'))
            ->setRoles(['ROLE_ADMIN'])
            ->setInfoUser($this->getReference('infoUser_1'));

        $manager->persist($user);
        $this->addReference('user_1', $user);

        // on créé les 3 clients (références de 2 à 4)
        for ($i = 2; $i <= 4; $i++) {
            $user = new User();
            $user->setEmail($this->faker->email);
            $user->setPassword($this->encoder->hashPassword($user, 'prof'));
            $user->setRoles(['ROLE_CLIENT']);
            $user->setInfoUser($this->getReference('infoUser_' . $i));

            $manager->persist($user);
            $this->addReference('user_' . $i, $user);
        }
    }

    // méthode qui alimente Stage
    public function loadStage(ObjectManager $manager)
    {
        $stageArray = [
            ['key' => 1, 'label' => 'Préparation Spartan Race', 'imagePath' => 'slack_line.jpg', 'description' => 'Stage en immersion pour se préparer aux Spartan Races. Nous aurons l\'occasion de travailler tous les points importants que nous allons retrouver dans une course à obstacles. Venez seul ou entre amis pour vous tester ou vous perfectionner.', 'dateStart' => '2021-01-23 10:00:00', 'dateEnd' => '2021-06-23 17:00:00', 'nbMaxPeople' => 12, 'addressId' => 1, 'priceAdult' => 200, 'priceChild' => 120]
        ];

        foreach ($stageArray as $value) {
            $stage = new Stage();
            $stage->setLabel($value['label']);
            $stage->setImagePath($value['imagePath']);
            $stage->setDescription($value['description']);
            $stage->setDateStart(new \DateTime($value['dateStart']));
            $stage->setDateEnd(new \DateTime($value['dateEnd']));
            $stage->setNbMaxPeople($value['nbMaxPeople']);
            $stage->setAddress($this->getReference('address_' . $value['addressId']));
            $stage->setPriceAdult($value['priceAdult']);
            $stage->setPriceChild($value['priceChild']);

            $manager->persist($stage);
            $this->addReference('stage_' . $value['key'], $stage);
        }
    }

    // méthode qui alimente réservation
    public function loadReservation(ObjectManager $manager)
    {
        $reservationArray = [
            ['key' => 1, 'stageId' => 1, 'userId' => 1, 'nbAdult' => 2, 'nbChild' => 2, 'isPayed' => 0],
            ['key' => 2, 'stageId' => 1, 'userId' => 2, 'nbAdult' => 1, 'nbChild' => 0, 'isPayed' => 1]
        ];

        foreach ($reservationArray as $value) {
            $reservation = new Reservation();
            $reservation->setStage($this->getReference('stage_' . $value['stageId']));
            $reservation->setUser($this->getReference('user_' . $value['userId']));
            $reservation->setNbAdult($value['nbAdult']);
            $reservation->setNbChild($value['nbChild']);
            $reservation->setIsPayed($value['isPayed']);

            $manager->persist($reservation);
            $this->addReference('reservation_' . $value['key'], $reservation);
        }
    }
}
