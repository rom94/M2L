<?php

namespace M2L\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\UserBundle\Entity\User;

class AdminController extends Controller
{
    public function adminAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
		
        $query = $em->createQuery(
            'SELECT a
            FROM M2LUserBundle:User a
            ');
        $userList = $query->getResult(); 

        return $this->render('M2LUserBundle::listeUser_admin.html.twig', array('userList'=>$userList));
    }

    public function supprimerAction($id, User $user)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();
        return $this->redirect($this->generateUrl('m2_l_user_admin'));
    }
}
