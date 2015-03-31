<?php

namespace M2L\galerieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GalerieAdminType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array('required' => false))
            ->add('name', 'text')
            ->add('enregistrer', 'submit', array('attr'=>array('class'=>'btn btn-primary')));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'M2L\galerieBundle\Entity\GalerieAdmin'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'm2l_galeriebundle_galerieAdmin';
    }
}
