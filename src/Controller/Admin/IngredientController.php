<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Form\IngredientFormType;
use App\Repository\IngredientRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class IngredientController extends AbstractController
{
    #[Route('/admin/ingredient', name: 'admin_ingredient')]
    public function ingredient(IngredientRepository $ingredientRepo): Response
    {
        return $this->render('admin/ingredient/admin-ingredient.html.twig', [
            'ingredients' => $ingredientRepo->findAll(),
        ]);
    }
        #[Route('/admin/ingredient/create/{id}', name: 'admin_ingredient_create')]
        public function ajoutRecette(ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger)
        {
            $ingredient = new Ingredient;
    
            $form = $this->createForm(IngredientFormType::class, $ingredient);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                    $em = $doctrine->getManager();
                    $em->persist($ingredient);
                    $em->flush();
            }
            return $this->render('/admin/ingredient/admin-ingredient-create.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/admin/ingredient/edit/{id}', name: 'admin_ingredient_edit')]
        public function ModifierIngredient(ManagerRegistry $doctrine, $id, SluggerInterface $slugger, Request $request)
        {
            $ingredientRepo = $doctrine->getRepository(ingredient::class);
            $ingredient = $ingredientRepo->findOneBy(['id'=>$id]);
            $form = $this->createForm(ingredientFormType::class, $ingredient);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($ingredient);
                $em->flush();
    
                return $this->redirectToRoute('/admin/ingredient');
            }
    
            return $this->render('/admin/ingredient/admin-ingredient-edit.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }
    
