<?php

namespace App\Controller\Admin;

use App\Entity\Regime;
use App\Form\RegimeFormType;
use App\Repository\RegimeRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegimeController extends AbstractController
{
    #[Route('/admin/regime', name: 'admin_regime')]
    public function regime(RegimeRepository $regimeRepo): Response
    {
        return $this->render('admin/regime/Admin-regime.html.twig', [
            'regimes' => $regimeRepo->findAll(),
        ]);
    }
        #[Route('/admin/regime/create/', name: 'admin_regime_create')]
        public function ajoutIngredient(ManagerRegistry $doctrine, Request $request)
        {
            $regime = new Regime;
    
            $form = $this->createForm(RegimeFormType::class, $regime);
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
    
                    $em = $doctrine->getManager();
                    $em->persist($regime);
                    $em->flush();

                    return $this->redirectToRoute('admin_regime');
            }
            return $this->render('/admin/regime/admin-regime-create.html.twig', [
                'form' => $form->createView()
            ]);
        }
    
        #[Route('/admin/regime/edit/{id}', name: 'admin_regime_edit')]
        public function ModifierRegime(ManagerRegistry $doctrine, $id, Request $request)
        {
            $regimeRepo = $doctrine->getRepository(Regime::class);
            $regime = $regimeRepo->findOneBy(['id'=>$id]);
            $form = $this->createForm(RegimeFormType::class, $regime);
    
            $form->handleRequest($request);
    
            if($form->isSubmitted() && $form->isValid()){
                $em = $doctrine->getManager();
                $em->persist($regime);
                $em->flush();
    
                return $this->redirectToRoute('admin_regime');
            }
    
            return $this->render('/admin/regime/admin-regime-edit.html.twig', [
                'form' => $form->createView()
            ]);
        }

        #[Route('/admin/regime/delete/{id}', name: 'admin_regime_delete')]
        public function DeleteRegime(Regime $regime, ManagerRegistry $doctrine): RedirectResponse
    {
        $em = $doctrine->getManager();
        $em->remove($regime);
        $em->flush();

        return $this->redirectToRoute("admin_regime");
    }
    }