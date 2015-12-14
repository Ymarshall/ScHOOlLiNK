<?php

namespace SL\PlateformBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class NotesTypeEdit extends AbstractType {

    private $id;

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        // Récupération de la session
        $this->id = $options['post_max_size_message'];
        $builder
                ->add('note')
                ->add('coefficient')
                ->add('dateCompo', 'date', array('required' => true,
                    'input' => 'datetime',
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd'))
                ->add('appreciation')
                ->add('type_note', 'entity', array('class' => 'SLPlateformBundle:Type_note',
                    'property' => 'libelle',
                    'multiple' => false,
                ))
              
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'SL\PlateformBundle\Entity\Notes'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'sl_plateformbundle_notes';
    }

}
