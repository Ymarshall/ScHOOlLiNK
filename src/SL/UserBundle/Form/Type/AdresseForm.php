<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of AdresseForm
 *
 * @author Meledje
 */
class AdresseForm extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('Ville', 'choice', array('choices' => array(
                                                                'Abidjan' => 'Abidjan',
                                                                'Gagnoa'     => 'Gagnoa',
                                                                'San-pedro'    => 'San-pedro',
                                                            ),
                                                            'label' => 'Ville',
                                                            'multiple' => false,'attr'=> 
                             array(
                                 'class'=> 'form-control')))
                
                ->add('Commune', 'choice', array('choices' => array(
                                                                'Yopougon' => 'Yopougon',
                                                                'Cocody'     => 'Cocody',
                                                                'Abobo'    => 'Abobo',
                                                            ),
                                                            'label' => 'Commune',
                                                            'multiple' => false,'attr'=> 
                             array(
                                 'class'=> 'form-control')))
                
                ->add('Quartier', 'choice', array('choices' => array(
                                                                'Annaneraie' => 'Annaneraie',
                                                                'Valon'     => 'Valon',
                                                                'Sicogi'    => 'Sicogi',
                                                            ),'attr'=> 
                             array(
                                 'class'=> 'form-control'),
                                                            'label' => 'Quartier',
                                                            'multiple' => false))
                
                ->add('Adresse', 'text',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: 01 bp xxxxx abj 01')))
            ;
                
    }
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'SL\PlateformBundle\Entity\Adresse'
    ));
  }
  
  /**
     * @return string
     */
    public function getName() {
        return 'sl_userbundle_adresse';
    }

//put your code here
}
