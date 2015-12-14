<?php

namespace SL\PlateformBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class EleveExamenType extends AbstractType
{
     private $id;
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Récupération de la session
        $this->id = $options['post_max_size_message'];
        $builder
            ->add('note')
            ->add('coefficient')
            ->add('appreciation')
            ->add('matiere','entity',array('class'=> 'SLPlateformBundle:Matiere',
                                                'property' => 'libelle',
                                                'multiple' => false,
                                                ))
            ->add('examen','entity',array('class'=> 'SLPlateformBundle:Examen',
                         'query_builder' => function (EntityRepository $es) {
                        return $es->createQueryBuilder('ex')
                                ->where('ex.id = ?1')
                                ->setParameter(1, $this->id);
                    },
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
            'data_class' => 'SL\PlateformBundle\Entity\EleveExamen'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'sl_plateformbundle_eleveexamen';
    }
}
