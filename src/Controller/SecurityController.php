<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route('/connecter', name: 'app_connecter')]
    public function connecter(): Response
    {
        return $this->render('connecter.html.twig', [
            'connecter_name' => 'SecurityController',
        ]);
    }

    #[Route('/moncompte', name: 'app_moncompte')]
    public function moncompte(): Response
    {
        return $this->render('moncompte.html.twig', [
            'moncompte_name' => 'SecurityController',
        ]);
    }
}
