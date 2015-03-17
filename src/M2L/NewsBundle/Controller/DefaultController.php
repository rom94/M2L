<?php

namespace M2L\NewsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use M2L\NewsBundle\Entity\Annonce;
use M2L\NewsBundle\Entity\Photo;
use M2L\UserBundle\Entity\User;
use M2L\NewsBundle\Form\AnnonceType;
use M2L\NewsBundle\Form\PhotoType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('M2LSiteBundle:Default:accueil.html.twig', array());
    }

    private function createCreateForm(Annonce $entity)
    {
        $form = $this->createForm(new AnnonceType(), $entity);
        return $form;
    }

    public function ajouterAction(Request $request)
    {
        $entity = new Annonce();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            // On récupère le service
            $security = $this->get('security.context');

            // On récupère le token
            $token = $security->getToken();

            // Si la requête courante n'est pas derrière un pare-feu, $token est null
            // Sinon, on récupère l'utilisateur
            $user = $token->getUser();

            $entity->setAuteur($user);

            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('m2_l_news_voir', array('id' => $entity->getId())));
        }

        return $this->render('M2LNewsBundle:Default:ajouter.html.twig', array(
            'entity' => $entity,
            'form' => $form->createView(),
        ));
    }

    public function listerAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $query = $em->createQuery(
            'SELECT a
        	FROM M2LNewsBundle:Annonce a
        	ORDER BY a.date DESC
        	');
        $annonceList = $query->getResult();

        return $this->render('M2LNewsBundle:Default:liste.html.twig', array('annonceList' => $annonceList));
    }

    private function createEditForm(Annonce $entity)
    {
        $form = $this->createForm(new AnnonceType(), $entity);
        return $form;
    }

    public function editerAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('M2LNewsBundle:Annonce')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Impossible de trouver l\'annonce.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('m2_l_news_voir', array('id' => $entity->getId())));
        }

        return $this->render('M2LNewsBundle:Default:editer.html.twig', array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
        ));
    }

    public function voirAction($id)
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        // On récupère le service
        $security = $this->get('security.context');

        // On récupère le token
        $token = $security->getToken();

        // Si la requête courante n'est pas derrière un pare-feu, $token est null
        // Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        // Si l'utilisateur courant est anonyme, $user vaut « anon. »

        $repo = $em->getRepository("M2LNewsBundle:Annonce");
        $annonce = $repo->find($id);
        $admin = false;

        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $admin = true;
        }

        return $this->render('M2LNewsBundle:Default:voir.html.twig', array('annonce' => $annonce, 'isAdmin' => $admin, 'user' => $user));
    }

    public function supprimerAction($id, Annonce $annonce)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($annonce);
        $em->flush();
        return $this->redirect($this->generateUrl('m2_l_news_liste'));
    }

    public function listerAccueilAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();
        $query = $em->createQuery(
            'SELECT a
            FROM M2LNewsBundle:Annonce a
            ORDER BY a.date DESC
            ')
            ->setMaxResults(4);
        $annonceList = $query->getResult();

        return $this->render('M2LNewsBundle:Default:liste_accueil.html.twig', array('annonceList' => $annonceList));
    }

    public function mesAnnoncesAction()
    {
        $doctrine = $this->getDoctrine();
        $em = $doctrine->getManager();

        // On récupère le service
        $security = $this->get('security.context');

        // On récupère le token
        $token = $security->getToken();

        // Si la requête courante n'est pas derrière un pare-feu, $token est null
        // Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        // Si l'utilisateur courant est anonyme, $user vaut « anon. »

        $query = $em->createQuery(
            "SELECT a
            FROM M2LNewsBundle:Annonce a
            WHERE a.auteur = :userTest
			ORDER BY a.date DESC
            ");
        $query->setParameter('userTest', $user->getUserName());
        $annonceList = $query->getResult();

        return $this->render('M2LNewsBundle:Default:liste.html.twig', array('annonceList' => $annonceList));
    }
}

?>