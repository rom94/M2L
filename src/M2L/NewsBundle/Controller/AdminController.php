<?php 

namespace M2L\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\NewsBundle\Entity\Annonce;
use M2L\NewsBundle\Entity\Photo;
use M2L\NewsBundle\Form\AnnonceType;
use M2L\NewsBundle\Form\PhotoType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
	public function adminAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $query = $em->createQuery(
            'SELECT a
            FROM M2LNewsBundle:Annonce a
            ');
        $annonceList = $query->getResult(); 

        return $this->render('M2LNewsBundle:Default:liste_admin.html.twig', array('annonceList'=>$annonceList));
    }
}


?>