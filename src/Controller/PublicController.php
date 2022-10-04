<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class PublicController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('accueil.html.twig', [
            'accueil_name' => 'PublicController',
        ]);
    }

    #[Route('/recette', name: 'recette')]
    public function recette(ManagerRegistry $doctrine, Security $security, RecetteRepository $recetteRepo): Response
    {
        /**
        * @var RecetteRepository
        */
        $repoRecette = $doctrine->getRepository(Recette::class);
        if($security->getUser()){
            $listeRecette = $repoRecette->recettesPatients($security->getUser());
        }else{
            $listeRecette = $repoRecette->recettesPubliques();
        }
        
        return $this->render('recette.html.twig', [
            'recette_name' => 'PublicController',
            'listeRecette' => $listeRecette,
            'recettes' => $recetteRepo->findAll()
        ]);
    }

    #[Route('/contact', name: 'nous-contacter')]
    public function contacter(): Response
    {
        return $this->render('contact.html.twig', [
            'contacter_name' => 'PublicController',
        ]);
    }

    #[Route('/mentionslegales', name: 'mention_legales')]
    public function mentionslegales(): Response
    {
        return $this->render('mentions-legales.html.twig', [
            'mention_name' => 'PublicController',
        ]);
    }

    #[Route('/politiqueconfidentialite', name: 'politique_confidentialite')]
    public function politiqueConf(): Response
    {
        return $this->render('politique-confidentialite.html.twig', [
            'politique_name' => 'PublicController',
        ]);
    }
}
