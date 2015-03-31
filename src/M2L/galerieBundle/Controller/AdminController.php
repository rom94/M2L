<?php

namespace M2L\galerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\galerieBundle\Entity\GalerieAdmin;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use M2L\galerieBundle\Form\GalerieAdminType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\Image;

class AdminController extends Controller
{

    private function createCreateForm(GalerieAdmin $entity)
    {
        $form = $this->createForm(new GalerieAdminType(), $entity);
        return $form;
    }

    private function createEditForm(GalerieAdmin $entity)
    {
        $editForm = $this->createForm(new GalerieAdminType(), $entity);
        return $editForm;
    }

    public function ajouterGalerieAction(Request $request)
    {
        $entity = new GalerieAdmin();
        $form = $this->createForm(new GalerieAdminType(), $entity);
        $form->handleRequest($request);

        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('m2_ladmin_galerie'));
        }

        return $this->render('M2LgalerieBundle:Default:ajouterGalerie.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView()
            ));
    }

    public function galerieAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $query = $em->createQuery(
            'SELECT a
            FROM M2LgalerieBundle:GalerieAdmin a
            ');
        $galerieList = $query->getResult(); 

        return $this->render('M2LgalerieBundle:Default:galerie_admin.html.twig', array('galerieList'=>$galerieList));
    }

    public function editerGalerieAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('M2LgalerieBundle:GalerieAdmin')->find($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if($editForm->isValid()){
            $em->flush();
            return $this->redirect($this->generateUrl('m2_ladmin_galerie', array('id'=>$entity->getId())));
        }

        return $this->render('M2LgalerieBundle:Default:editerGalerie.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView()
            ));
    }
}
