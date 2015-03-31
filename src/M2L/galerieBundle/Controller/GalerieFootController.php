<?php

namespace M2L\galerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BTS2\galerieBundle\Entity\GalerieAdmin;

class GalerieFootController extends Controller
{
    public function galerieFootAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $query = $em->createQuery(
         'SELECT a
         FROM M2LgalerieBundle:GalerieAdmin a
         ');
        $galerieList = $query->getResult(); 

        return $this->render('M2LgalerieBundle:Default:galerieFoot.html.twig', array('galerieList'=>$galerieList));
    }
}

?>