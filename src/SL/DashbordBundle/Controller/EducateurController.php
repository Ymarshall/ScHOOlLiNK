<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SL\PlateformBundle\Entity\Details_cr;
use SL\PlateformBundle\Form\Details_crType;

class EducateurController extends Controller{
    
      //methode pour afficher la vue du carnet de correspondance d'un eleve
    public function carnetCorrespondanceAction($id, Request $request)
    {    
        $session = $request->getSession();
            $session->set('eleve_courant', $id);
            
          //recuperation de l'éleve
        $repositoryEleve = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $lEleve=$repositoryEleve->find($id);
        
        //formulaire d'attribution
        $entity = new Details_cr();
        $form   = $this->createCreateForm($entity);
        
         //recuperation des type de details cr
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Type_details_cr');
        $lesTypes=$repository->getTypeDetailsByUser2($id);
        return $this->render('SLDashbordBundle:Educateur:carnetCorrespondance.html.twig', array('lesTypes' => $lesTypes,'lEleve' => $lEleve,'entity' => $entity,
            'form'   => $form->createView()));
    }
    
    private function createCreateForm(Details_cr $entity)
    {
        $form = $this->createForm(new Details_crType(), $entity, array(
            'action' => $this->generateUrl('details_cr_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }
}
