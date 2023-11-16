<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\User;
use Faker\Generator;
use App\Entity\Media;
use App\Entity\Stage;
use App\Entity\Address;
use App\Entity\Contact;
use App\Entity\Gallery;
use App\Entity\Product;
use App\Entity\InfoUser;
use App\Entity\Facturation;
use App\Entity\Reservation;
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

        // fonction loadContact
        $this->loadContact($manager);
        // fonction loadAddress
        $this->loadAddress($manager);
        // fonction loadFacturation
        $this->loadFacturation($manager);
        // fonction loadGallery
        $this->loadGallery($manager);
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
        // fonction loadMedia
        $this->loadMedia($manager);

        // on flush pour envoyer vers la BDD avec le d:f:l
        $manager->flush();
    }

    // méthode random pour boolean
    function randomBoolean()
    {
        $randomNumber = rand(0, 1);
        return $randomNumber === 1;
    }

    // méthode qui alimente Contact
    public function loadContact(ObjectManager $manager)
    {
        $contactArray = [
            ['key' => 1, 'name' => 'Exemple', 'firstname' => 'Exemple', 'phone' => '06235325852', 'email' => 'exemple@exemple.com', 'message' => 'Exemple de message dans la prise de contact depuis les fixtures.']
        ];

        foreach ($contactArray as $value) {
            $contact = new Contact();
            $contact->setName($value['name']);
            $contact->setFirstname($value['firstname']);
            $contact->setPhone($value['phone']);
            $contact->setEmail($value['email']);
            $contact->setMessage($value['message']);

            $manager->persist($contact);
            $this->addReference('contact_' . $value['key'], $contact);
        }
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

    // méthode qui alimente Gallery
    public function loadGallery(ObjectManager $manager)
    {
        $galleryArray = [
            ['key' => 1, 'label' => 'Andorra charlotte 2022 filet', 'imagePath' => 'filet1.jpg'],
            ['key' => 2, 'label' => 'Anne-Sarah Laurent Alex Mag Charlotte Lucie', 'imagePath' => 'team5.jpg'],
            ['key' => 3, 'label' => 'Aline en course', 'imagePath' => 'team2.jpg'],
            ['key' => 4, 'label' => 'Anne-Marie Laurent slake lines', 'imagePath' => 'slack_line.jpg'],
            ['key' => 5, 'label' => 'Lucie pancakes carcassonne', 'imagePath' => 'pancakes2.jpg'],
            ['key' => 6, 'label' => 'Course Ceret', 'imagePath' => 'team13.png'],
            ['key' => 7, 'label' => 'Charlotte et Lucie', 'imagePath' => 'team1.jpg'],
            ['key' => 8, 'label' => 'Guilhem javelot morzine', 'imagePath' => 'javelot.png'],
            ['key' => 9, 'label' => 'Tom chaine carry Andorra', 'imagePath' => 'chain_carry2.jpg'],
            ['key' => 10, 'label' => 'Andorra podium AG clem 2023', 'imagePath' => 'andorra2023_podium1.jpg'],
            ['key' => 11, 'label' => 'Tom Lucie Charlotte', 'imagePath' => 'team3.jpg'],
            ['key' => 12, 'label' => 'Anne-Sarah Carcassonne multi rings', 'imagePath' => 'multi_rings2.jpg'],
            ['key' => 13, 'label' => 'Anne-Sarah Mag Guilhem', 'imagePath' => 'team4.jpg'],
            ['key' => 14, 'label' => 'Depart femmes Elite 2022 esterel', 'imagePath' => 'esterel2022_depart_super_elite.jpg'],
            ['key' => 15, 'label' => 'Team entrainement Baixas', 'imagePath' => 'team6.jpg'],
            ['key' => 16, 'label' => 'Esterel podium Elite clem 2023', 'imagePath' => 'esterel2023_podium.png'],
            ['key' => 17, 'label' => 'Team entrainement Baixas2', 'imagePath' => 'team7.jpg'],
            ['key' => 18, 'label' => 'Course Reynes', 'imagePath' => 'team8.jpg'],
            ['key' => 19, 'label' => 'Andorra podium AG clem 2022', 'imagePath' => 'andorra2022_podium1.jpg'],
            ['key' => 20, 'label' => 'Course PO', 'imagePath' => 'team9.jpg'],
            ['key' => 21, 'label' => 'Anne-Marie Charlotte Lucie Sandra Aline', 'imagePath' => 'team10.jpg'],
            ['key' => 22, 'label' => 'Team entrainement renfo', 'imagePath' => 'team11.jpg'],
            ['key' => 23, 'label' => 'Team entrainement piste', 'imagePath' => 'team12.jpg'],
            ['key' => 24, 'label' => 'Alexandre atlas carcassonne', 'imagePath' => 'atlas.jpg'],
            ['key' => 25, 'label' => 'Etienne chaine carry Andorra', 'imagePath' => 'chain_carry1.jpg'],
            ['key' => 26, 'label' => 'Coach on the wall', 'imagePath' => 'terrain3.jpg'],
            ['key' => 27, 'label' => 'Sandra Rope traverse', 'imagePath' => 'traverse_rope.jpg'],
            ['key' => 28, 'label' => 'Etienne bucket esterel', 'imagePath' => 'esterel2022_bucket_carry.jpg'],
            ['key' => 29, 'label' => 'Anne-Marie podium espagne', 'imagePath' => 'podium1.jpg'],
            ['key' => 30, 'label' => 'Lin rope climb carcassonne', 'imagePath' => 'rope_climb.jpg'],
            ['key' => 31, 'label' => 'Guilhem poduim FNS 2022', 'imagePath' => 'esterel2022_podium1.jpg'],
            ['key' => 32, 'label' => 'Esterel podium AG etienne 2022', 'imagePath' => 'esterel2022_podium2.jpg'],
            ['key' => 33, 'label' => 'Esterel podium AG guilhem 2022', 'imagePath' => 'esterel2022_podium3.jpg'],
            ['key' => 34, 'label' => 'Esterel final line clem 2023', 'imagePath' => 'final_line.jpg'],
            ['key' => 35, 'label' => 'Carcassonne fire jump mag 2023', 'imagePath' => 'firejump.jpg'],
            ['key' => 36, 'label' => 'Filet terrain', 'imagePath' => 'filet2.png'],
            ['key' => 37, 'label' => 'Flag spartacademy', 'imagePath' => 'flag.jpg'],
            ['key' => 38, 'label' => 'Logo OCR gris', 'imagePath' => 'img3.png'],
            ['key' => 39, 'label' => 'Inverted Wall terrain', 'imagePath' => 'inverted_wall.png'],
            ['key' => 40, 'label' => 'Logo casque Spartacademy', 'imagePath' => 'logo_casque.jpg'],
            ['key' => 41, 'label' => 'Logo grand Spartacademy', 'imagePath' => 'logo_spartacademy.jpg'],
            ['key' => 42, 'label' => 'Logo OCR orange', 'imagePath' => 'logo-ocr-base.png'],
            ['key' => 43, 'label' => 'Logo spartan Orange', 'imagePath' => 'logo-spartan-base.png'],
            ['key' => 44, 'label' => 'Logo spartan gris penché', 'imagePath' => 'logo-spartan-gris-transparent.png'],
            ['key' => 45, 'label' => 'Logo spartan gris droit', 'imagePath' => 'logo-spartan-gris.png'],
            ['key' => 46, 'label' => 'Camion echelle singe club', 'imagePath' => 'monkeybar_nomade.jpg'],
            ['key' => 47, 'label' => 'Terrain multi rings', 'imagePath' => 'multi_rings1.png'],
            ['key' => 48, 'label' => 'Logo OCR vert', 'imagePath' => 'ocrwc.png'],
            ['key' => 49, 'label' => 'Pancakes spartacademy', 'imagePath' => 'pancakes1.png'],
            ['key' => 50, 'label' => 'Logo spartan classique', 'imagePath' => 'spartan.png'],
            ['key' => 51, 'label' => 'Spear throw crea', 'imagePath' => 'spear-throw-example.png'],
            ['key' => 52, 'label' => 'T-shirt Spartacademy', 'imagePath' => 't-shirt-spartacademy.png'],
            ['key' => 53, 'label' => 'Twister Filet terrain', 'imagePath' => 'terrain1.jpg'],
            ['key' => 54, 'label' => 'Wall and Monkey terrain', 'imagePath' => 'terrain2.jpg'],
            ['key' => 55, 'label' => 'Twister terrain', 'imagePath' => 'twister.png'],
            ['key' => 56, 'label' => 'Coach on the wall2', 'imagePath' => 'wall1.jpg'],
            ['key' => 57, 'label' => 'Walls terrain', 'imagePath' => 'wall2.png']
        ];

        foreach ($galleryArray as $value) {
            $gallery = new Gallery();
            $gallery->setLabel($value['label']);
            $gallery->setImagePath($value['imagePath']);

            $manager->persist($gallery);
            $this->addReference('gallery_' . $value['key'], $gallery);
        }
    }

    // méthode qui alimente Product
    public function loadProduct(ObjectManager $manager)
    {
        $productArray = [
            ['key' => 1, 'label' => 'Drapeau', 'description' => 'Voici le drapeau de notre club. N\'hésitez pas à l\'amener avec vous sur vos évènemets sportifs et le prendre avec vous sur vos futurs podiums !', 'price' => 9],
            ['key' => 2, 'label' => 'T-shirt', 'description' => 'Tenue officielle Spartacademy, T-shirt disponible dans les tailles XS, S, M, L et XL. Nous avons une coupe pour les hommes ainsi qu\'une coupe pour les femmes', 'price' => 19],
        ];

        foreach ($productArray as $value) {
            $product = new Product();
            $product->setLabel($value['label']);
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
            $user->setPassword($this->encoder->hashPassword($user, 'client'));
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
            ['key' => 1, 'label' => 'Préparation Spartan Race', 'description' => 'Stage en immersion pour se préparer aux Spartan Races. Nous aurons l\'occasion de travailler tous les points importants que nous allons retrouver dans une course à obstacles. Venez seul ou entre amis pour vous tester ou vous perfectionner.', 'dateStart' => '2021-01-23 10:00:00', 'dateEnd' => '2021-06-23 17:00:00', 'nbMaxPeople' => 12, 'addressId' => 1, 'priceAdult' => 200, 'priceChild' => 120]
        ];

        foreach ($stageArray as $value) {
            $stage = new Stage();
            $stage->setLabel($value['label']);
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

    // méthode qui alimente média
    public function loadMedia(objectManager $manager)
    {
        $mediaArray = [
            ['key' => 1, 'label' => 'Exemple média', 'description' => 'Superbe compétition de sport à obstacles à perpignan !', 'dateStart' => '2021-01-23 10:00:00', 'dateEnd' => '2021-02-23 17:00:00']
        ];

        foreach ($mediaArray as $value) {
            $media = new Media();
            $media->setLabel($value['label']);
            $media->setDescription($value['description']);
            $media->setDateStart(new \DateTime($value['dateStart']));
            $media->setDateEnd(new \DateTime($value['dateEnd']));

            $manager->persist($media);
            $this->addReference('media_' . $value['key'], $media);
        }
    }
}
