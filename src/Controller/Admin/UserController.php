<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/admin/user', name: 'admin_user')]
    public function index(UserRepository $userRepo): Response
    {
        return $this->render('/admin/user/admin-user.html.twig', [
            'users' => $userRepo->findAll(),
        ]);
    }
    #[Route('/admin/user/create/', name: 'admin_user_create')]
        public function ajoutUser(ManagerRegistry $doctrine, Request $request)
        {
            $user = new User;
    
            $form = $this->createForm(UserFormType::class, $user);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                    $em = $doctrine->getManager();
                    $em->persist($user);
                    $em->flush();
            }
            return $this->render('/admin/user/admin-user-create.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/admin/user/edit/{id}', name: 'admin_user_edit')]
        public function ModifierUser(ManagerRegistry $doctrine, $id, Request $request)
        {
            $userRepo = $doctrine->getRepository(User::class);
            $user = $userRepo->findOneBy(['id'=>$id]);
            $form = $this->createForm(UserFormType::class, $user);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($user);
                $em->flush();
    
                return $this->redirectToRoute('/admin/user');
            }
    
            return $this->render('/admin/user/admin-user-edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
}
