<?php

namespace M2L\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('M2LUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
