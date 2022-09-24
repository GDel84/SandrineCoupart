<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    #[Route('/admin/regime', name: 'admin_regime')]
    public function regime(): Response
    {
        return $this->render('admin/regime/Admin-regimehtml.twig', [
            'controller_name' => 'RegimeController',
        ]);
    }
}
