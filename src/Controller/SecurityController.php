<?php

namespace App\Controller;

use App\Form\UserClientFormType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/connecter', name: 'connecter')]
    public function connecter(): Response
    {
        return $this->render('connecter.html.twig', [
            'connecter_name' => 'SecurityController',
        ]);
    }

    #[Route('/moncompte', name: 'moncompte')]
    public function MonCompteUser(ManagerRegistry $doctrine, Request $request, Security $security)
        {
            $user = $security->getUser();
            $form = $this->createForm(UserClientFormType::class, $user);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){

                $user = $form->getData();
                $em = $doctrine->getManager();
                $em->persist($user);
                $em->flush();
    
            }
        return $this->render('moncompte.html.twig', [
            'moncompte_name' => 'SecurityController',
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
