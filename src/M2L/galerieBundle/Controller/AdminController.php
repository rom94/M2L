<?php

namespace M2L\galerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BTS2\galerieBundle\Entity\GalerieAdmin;

class AdminController extends Controller
{
    public function GalerieAdminAction()
    {
    	$doctrine = $this->getDoctrine();
    	$em = $doctrine->getManager();
    	$repo = $em->getRepository("M2LgalerieBundle:GalerieAdmin");
    	$admin = $repo->findAll();

    	return $this->render('M2LgalerieBundle:Default:GalerieAdmin.html.twig', array('admin'=>$admin));
        
    }
}
