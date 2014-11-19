<?php

namespace M2L\galerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BTS2\galerieBundle\Entity\Image;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	$doctrine = $this->getDoctrine();
    	$em = $doctrine->getManager();
    	$repo = $em->getRepository("M2LgalerieBundle:Image");
    	$images = $repo->findAll();

    	return $this->render('M2LgalerieBundle:Default:index.html.twig', array('images'=>$images));
        
    }
}
