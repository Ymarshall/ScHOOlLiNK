<?php

namespace SL\PlateformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ComposantType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('heureDebut')
            ->add('heureFin')
            ->add('matiere','entity',array('class'=> 'SLPlateformBundle:Matiere',
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
            'data_class' => 'SL\PlateformBundle\Entity\Composant'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_composant';
    }
}
