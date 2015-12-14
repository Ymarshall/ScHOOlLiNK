<?php

namespace SL\PlateformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class Details_crType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet')
            ->add('description')
            ->add('type_details_cr','entity',array('class'=> 'SLPlateformBundle:Type_details_cr',
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
            'data_class' => 'SL\PlateformBundle\Entity\Details_cr'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_details_cr';
    }
}
