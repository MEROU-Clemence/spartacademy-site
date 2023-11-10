<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// dans ce fichier on va déclarer nos routes
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        // je déclare mes variables
        $title = "Hello mon site, on démarre le projet ?";

        return $this->render('home/index.html.twig', [
            'title' => $title
        ]);
    }
}
