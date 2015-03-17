<?php

namespace M2L\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('ligue', 'choice', array('choices' => array('foot' => 'Football', 'tennis' => 'Tennis')));
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'm2l_user_registration';
    }
}