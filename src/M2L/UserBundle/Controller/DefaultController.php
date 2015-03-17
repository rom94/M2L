<?php

namespace M2L\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function accueilAction()
    {
        return $this->render('M2LSiteBundle:Default:accueil.html.twig', array());
    }
}
