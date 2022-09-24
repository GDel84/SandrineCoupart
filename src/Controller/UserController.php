<?php

namespace App\Controller;

use App\Form\UserClientFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;


class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function userProfil(ManagerRegistry $doctrine, Request $request, Security $security): Response
    {
        
        //recuperer le user connecte
        //creer le form type et gerer la soumission
            //persister l'object
            $user = $security->getUser();
            $form = $this->createForm(UserClientFormType::class, $user);
            
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                $user = $form->getData();
                $manager = $doctrine->getManager();
                $manager->persist($user);
                $manager->flush();
                // ... perform some action, such as saving the task to the database
            }

        return $this->render('/user/index.html.twig', [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
        ]);
    }
}
