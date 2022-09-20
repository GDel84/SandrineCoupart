<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublicController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('accueil.html.twig', [
            'accueil_name' => 'PublicController',
        ]);
    }

    #[Route('/recette', name: 'recette')]
    public function recette(): Response
    {
        return $this->render('recette.html.twig', [
            'recette_name' => 'PublicController',
        ]);
    }

    #[Route('/contact', name: 'nous-contacter')]
    public function contacter(): Response
    {
        return $this->render('contact.html.twig', [
            'contacter_name' => 'PublicController',
        ]);
    }

    #[Route('/mentionslegales', name: 'mention_legales')]
    public function mentionslegales(): Response
    {
        return $this->render('mentions-legales.html.twig', [
            'mention_name' => 'PublicController',
        ]);
    }

    #[Route('/politiqueconfidentialite', name: 'politique_confidentialite')]
    public function politiqueConf(): Response
    {
        return $this->render('politique-confidentialite.html.twig', [
            'politique_name' => 'PublicController',
        ]);
    }
}
