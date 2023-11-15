<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Gallery;
use App\Form\ContactType;
use App\Repository\GalleryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// dans ce fichier on va déclarer nos routes
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, GalleryRepository $galleryRepository, EntityManagerInterface $entityManager): Response
    {
        // ma galerie limitée à 35
        $gallery = $galleryRepository->getFirst35Gallery();

        // mes contacts
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Sauvegarde en BDD dans la table Contact
            $entityManager->persist($contact);
            $entityManager->flush();

            // popup pour dire que le message est bien envoyé
            return $this->render('home/index.html.twig', [
                'gallery' => $gallery,
                'contact' => $contact,
                'form' => $form->createView(),
                'modaleClass' => 'd-flex'
            ]);
        }

        return $this->render('home/index.html.twig', [
            'gallery' => $gallery,
            'contact' => $contact,
            'form' => $form->createView(),
            'modaleClass' => 'd-none'
        ]);
    }
}
