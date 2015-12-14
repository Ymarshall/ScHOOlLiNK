<?php

namespace SL\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParentsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('situationMatri', 'choice', array('choices' => array(
                                                                'Marié' => 'Marié',
                                                                'Célibaraire'     => 'Célibaraire',
                                                                'Divorcé'    => 'Divorcé',
                                                            ),
                                                            'label' => 'Situation matrimoniale',
                                                            'multiple' => false))
            ->add('personne',new \SL\UserBundle\Form\RegistrationType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SL\PlateformBundle\Entity\Parents'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_parents';
    }
}
