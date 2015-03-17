<?php

namespace M2L\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text')
            ->add('texte', 'textarea')
            ->add('date', 'date')
            ->add('prix', 'integer', array('attr'=>array('step'=>'any')))
            ->add('photo', new PhotoType())
            ->add('enregistrer', 'submit', array('attr'=>array('class'=>'btn btn-primary' )))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'M2L\NewsBundle\Entity\Annonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'm2l_newsbundle_annonce';
    }
}
