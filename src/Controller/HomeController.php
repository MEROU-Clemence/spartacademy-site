<?php

namespace App\Controller;

use App\Entity\Gallery;
use App\Form\ContactType;
use App\Repository\GalleryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// dans ce fichier on va déclarer nos routes
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET', 'POST'])]
    public function index(Request $request, GalleryRepository $galleryRepository): Response
    {
        // Créez un tableau pour stocker les données du formulaire
        $formData = [];

        // je déclare mes variables
        $form = $this->createForm(ContactType::class, $formData);
        $gallerys = $galleryRepository->findAll();

        // soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // TODO: envoyer en BDD avec onglet pour recevoir coté admin.
            // TODO: faire popup pour dire que le message est bien envoyé
            return $this->redirectToRoute('nom_de_popup_qui_dit_ok_message_bien_envoyé');
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'gallerys' => $gallerys
        ]);
    }
}
