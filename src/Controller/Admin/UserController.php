<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'admin_user')]
    public function index(): Response
    {
        return $this->render('/admin/user/admin-user.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
