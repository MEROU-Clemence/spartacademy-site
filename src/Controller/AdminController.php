<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\GalleryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, GalleryRepository $galleryRepository, EntityManagerInterface $entityManager): Response
    {
        // ma galerie limitée à 4
        $gallerys = $galleryRepository->getFirst4Gallery();

        // mes contacts
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Sauvegarde en BDD dans la table Contact
            $entityManager->persist($contact);
            $entityManager->flush();

            // popup pour dire que le message est bien envoyé
            return $this->render('home/monCompteAdmin.html.twig', [
                'gallerys' => $gallerys,
                'contact' => $contact,
                'form' => $form->createView(),
                'modaleClass' => 'd-flex'
            ]);
        }

        return $this->render('home/monCompteAdmin.html.twig', [
            'gallerys' => $gallerys,
            'contact' => $contact,
            'form' => $form->createView(),
            'modaleClass' => 'd-none'
        ]);
    }
}
