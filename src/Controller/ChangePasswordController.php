<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordFormType;
use App\Service\AdminService;
use Doctrine\Persistence\ManagerRegistry;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class ChangePasswordController extends AbstractController
{
    #private $adminUrlGenerator;
    #private $requestStack;
    #private $adminService;
#
    #public function __construct(AdminUrlGenerator $adminUrlGenerator, RequestStack $requestStack, AdminService $adminService)
    #{
    #    $this->adminUrlGenerator = $adminUrlGenerator;
    #    $this->requestStack = $requestStack;
    #    $this->adminService = $adminService;
    #}

    #[Route('/changepassword', name: 'app_change_password')]
    public function index(Request $request, Security $security, ManagerRegistry $managerRegistry, UserPasswordHasherInterface $userPasswordHasher): Response
    {   
        
        $entityManager = $managerRegistry->getManager();
        /** @var User $user */
        $user = $security->getUser();
        $form = $this->createForm(ChangePasswordFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $password = $form->get('password')->getData();
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $password
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('accueil');
        }

        return $this->render('user/changepassword.html.twig', [
            'form' => $form->createView()
        ]);
    }

}