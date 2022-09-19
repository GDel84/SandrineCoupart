<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    #[Route('/regime', name: 'app_regime')]
    public function index(): Response
    {
        return $this->render('regime/index.html.twig', [
            'controller_name' => 'RegimeController',
        ]);
    }
}
