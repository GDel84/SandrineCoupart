<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'admin_ingredient')]
    public function ingredient(): Response
    {
        return $this->render('admin/ingredient/admin-ingredient.html.twig', [
            'controller_name' => 'IngredientController',
        ]);
    }
}
