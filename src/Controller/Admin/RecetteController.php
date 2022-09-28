<?php

namespace App\Controller\Admin;

use App\Entity\Etape;
use App\Entity\Ingredient;
use App\Entity\IngredientRecette;
use App\Entity\Recette;
use App\Form\EtapeFormType;
use App\Form\IngredientRecetteFormType;
use App\Form\RecetteFormType;
use App\Repository\RecetteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecetteController extends AbstractController
{
    #[Route('/admin/accueil', name: 'admin_accueil')]
    public function accueil(): Response
    {
        return $this->render('/admin/adminAccueil.html.twig', [
            'controller_name' => 'RecetteController',
        ]);
    }

    #[Route('/admin/recette', name: 'admin_recette')]
    public function index(RecetteRepository $recetteRepo): Response
    {
        return $this->render('/admin/recette/admin-recette.html.twig', [
            'recettes' => $recetteRepo->findAll(),
        ]);
    }

    #[Route('/admin/recette/create/', name: 'admin_recette_create')]
    public function ajoutRecette(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger)
    {
        $recette = new Recette;

        $form = $this->createForm(RecetteFormType::class, $recette);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $pictureFile = $form->get('photo')->getData();
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $pictureFile->move(
                        $this->getParameter('picture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recette->setPhoto($newFilename);

                $em = $doctrine->getManager();
                $em->persist($recette);
                $em->flush();
            }
            return $this->redirectToRoute('/admin/recette');
        }
        return $this->render('/admin/recette/Admin-recette-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/recette/edit/{id}', name: 'admin_recette_edit')]
    public function ModifierRecette(ManagerRegistry $doctrine, $id, SluggerInterface $slugger, Request $request)
    {
        $recetteRepo = $doctrine->getRepository(Recette::class);
        $recette = $recetteRepo->findOneBy(['id'=>$id]);
        $form = $this->createForm(RecetteFormType::class, $recette);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $pictureFile = $form->get('photo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $pictureFile->move(
                        $this->getParameter('picture_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $recette->setPhoto($newFilename);
            }

            $em = $doctrine->getManager();
            $em->persist($recette);
            $em->flush();

            return $this->redirectToRoute('/admin/recette');
        }
        return $this->render('/admin/recette/admin-recette-edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/recette/ingredient/create/{idrecette}', name: 'admin_recette_ingredient_create')]
        public function ajoutRecetteIngredient(ManagerRegistry $doctrine, Request $request)
        {
            $ingredientRecette = new IngredientRecette;
    
            $form = $this->createForm(IngredientRecetteFormType::class, $ingredientRecette);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                    $em = $doctrine->getManager();
                    $em->persist($ingredientRecette);
                    $em->flush();
            }
            return $this->render('/admin/recette/ingredient/admin-recette-ingredient-create.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/admin/recette/ingredient/edit/{id}', name: 'admin_recette_ingredient_edit')]
        public function ModifierRecetteIngredient(ManagerRegistry $doctrine, $id, Request $request)
        {
            $ingredientRecetteRepo = $doctrine->getRepository(IngredientRecette::class);
            $ingredientRecette = $ingredientRecetteRepo->findOneBy(['id'=>$id]);
            $form = $this->createForm(IngredientRecetteFormType::class, $ingredientRecette);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($ingredientRecette);
                $em->flush();
    
                return $this->redirectToRoute('/admin/ingredient');
            }
    
            return $this->render('/admin/recette/ingredient/admin-recette-ingredient-edit.html.twig', [
                'form' => $form->createView()
            ]);
        }

        #[Route('/admin/recette/etape/create/{idrecette}', name: 'admin_recette_etape_create')]
        public function ajoutEtape(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger)
        {
            $etape = new Etape;
    
            $form = $this->createForm(EtapeFormType::class, $etape);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                    $em = $doctrine->getManager();
                    $em->persist($etape);
                    $em->flush();
            }
            return $this->render('/admin/recette/etape/Admin-recette-etape-create.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/admin/recette/etape/edit/{id}', name: 'admin_recette_etape_edit')]
        public function ModifierEtape(ManagerRegistry $doctrine, $id, Request $request)
        {
            $etapeRepo = $doctrine->getRepository(ingredient::class);
            $etape = $etapeRepo->findOneBy(['id'=>$id]);
            $form = $this->createForm(EtapeFormType::class, $etape);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($etape);
                $em->flush();
    
                return $this->redirectToRoute('/admin/ingredient');
            }
    
            return $this->render('/admin/recette/etape/Admin-recette-etape-edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
}
