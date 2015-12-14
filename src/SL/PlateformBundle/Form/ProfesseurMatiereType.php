<?php

namespace SL\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProfesseurMatiereType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matiere','entity',array('class'=> 'SLPlateformBundle:Matiere',
                                                'property' => 'libelle',
                                                'multiple' => false,
                                                ))
            ->add('classe','entity',array('class'=> 'SLPlateformBundle:Classe',
                                                'property' => 'libelle',
                                                'multiple' => false,
                                                ))
           
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SL\PlateformBundle\Entity\ProfesseurMatiere'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_professeurmatiere';
    }
}
