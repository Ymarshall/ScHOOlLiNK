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


class RegistrationEditType extends AbstractType {
    
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom','text',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: Kouassi')))
                ->add('prenoms','text',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: Jean')))
                ->add('dateNaissance', 'birthday',array('attr'=> 
                             array(
                                'class'=> 'form-control')))
                ->add('telephone','text',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: 02030405')))
                ->add('email','email',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: kouassi@xxx.com')))
                
                ->add('username','text',array('attr'=> 
                             array(
                                 'class'=> 'form-control','placeholder'=>'ex: kouassi2'),'label' => 'Login',))
               
                                
                ->add('sexe', 'entity', array('class'=> 'SLPlateformBundle:Sexe',
                                                'property' => 'libelle',
                                                'multiple' => false,
                                                'attr'=> 
                             array(
                                 'class'=> 'form-control')
                                              ))
                ->add('roles', 'choice', array(
                                            'choices' => array(
                                                                'ROLE_USER' => 'Utilisateur',
                                                                'ROLE_ADMIN'     => 'Administrateur',
                                                                'ROLE_SUPER_ADMIN'    => 'Super Administrateur',
                                                                'ROLE_ELEVE'    => 'Eleve',
                                                                'ROLE_PROFESSEUR' => 'Professeur',
                                                                'ROLE_PARENT'     => 'Parent',
                                                                'ROLE_EDUCATEUR'    => 'Educateur',
                                                            ),
                                            'label' => 'Roles',
                                            'expanded' => true,
                                            'multiple' => true,
                                            'mapped' => true,
                    'attr'=> 
                             array(
                                 'class'=> 'form-control')
    ))
                ->add('adresse',      new AdresseForm())
                ;
    }
   /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'SL\PlateformBundle\Entity\User'
        ));
    }
    
    
    public function getName() {
        return 'sl_user_registration';
    }

}
