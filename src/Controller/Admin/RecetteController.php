<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReccetteController extends AbstractController
{
    #[Route('/recette', name: 'admin_recette')]
    public function index(): Response
    {
        return $this->render('/admin/recette/admin-recette.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }
}
