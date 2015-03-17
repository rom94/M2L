<?php

namespace M2L\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function accueilAction()
    {
        return $this->render('M2LSiteBundle:Default:accueil.html.twig', array());
    }

    public function accueilTennisAction()
    {
        return $this->render('M2LSiteBundle:Default:accueil_tennis.html.twig', array());
    }

    public function accueilFootballAction()
    {
        return $this->render('M2LSiteBundle:Default:accueil_football.html.twig', array());
    }
	
	public function contactAction()
    {
        return $this->render('M2LSiteBundle:Default:contact.html.twig', array());
    }

	public function cguAction()
    {
        return $this->render('M2LSiteBundle:Default:mentions_legales.html.twig', array());
    }
}
