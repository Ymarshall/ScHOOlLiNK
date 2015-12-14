<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Description of RegistrationType
 *
 * @author Meledje
 */
class ProfileType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('nom', null, array('label' => 'Nom', 'translation_domain' => 'FOSUserBundle'))
                ->add('prenoms', null, array('label' => 'Prenoms', 'translation_domain' => 'FOSUserBundle'))
                ->add('dateNaissance', null, array('label' => 'Date de Naissance', 'translation_domain' => 'FOSUserBundle'))
                ->add('telephone', null, array('label' => 'Telephone', 'translation_domain' => 'FOSUserBundle'))
                ->add('sexe', 'entity', array('class'=> 'SLPlateformBundle:Sexe',
                                                'property' => 'libelle',
                                                'multiple' => false,
                                                'translation_domain' => 'FOSUserBundle')
                                              )
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
    ))
                ->add('adresse',      new AdresseForm())
                ;
    }
    public function getParent() {
        return 'fos_user_profile';
    }
    public function getName() {
        return 'sl_user_profile';
    }
    

//put your code here
}
