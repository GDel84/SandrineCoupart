<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class DefaultController
{
    /**
     * @Route("/", name="accueil")
     */ 
    public function accueil()
    {
        return $this->render('accueil.html.twig');
    }
}