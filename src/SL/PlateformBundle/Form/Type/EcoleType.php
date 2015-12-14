<?php

namespace SL\PlateformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EcoleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('dateCreation','date', array(
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'format' => 'dd/MM/yyyy'))
            ->add('localisation')
            ->add('latitude')
            ->add('longitude')
            ->add('descriptif')
            ->add('telephone')
            ->add('fax')
            ->add('email')
            ->add('siteWeb')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SL\PlateformBundle\Entity\Ecole'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_ecole';
    }
}
