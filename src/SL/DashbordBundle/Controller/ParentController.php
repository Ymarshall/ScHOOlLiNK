<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ParentController extends Controller{
       
        //methode pour afficher la vue du carnet de correspondance
    public function cahierTextAction(Request $request,$nombre)
    {
        //recuperation de la variable session
        $session=$request->getSession();
                 
            //recuperation de la matiere
             $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
            $laMatiere=$repositoryMatiere->find($nombre);
        //recuperation du contenu du cahier de text de la matiere $id et de la classe getUserClasse
            //recuperons la classe
            $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $laClasse=$repositoryClasse->getUserClasse($session->get('enfant'));
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Details_ct');
        $lesDetails=$repository->getDetailsCt($nombre, $laClasse->getId());
        return $this->render('SLDashbordBundle:Dashbord:cahierText.html.twig', array('lesDetails' => $lesDetails, 'laMatiere' => $laMatiere));
    }
    
      //methode pour afficher la vue des devoirs et interro
    public function interroDevAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        //recuperation des type de notes
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Type_note');
        $lesNotes=$repository->getTypeNotesByUser($session->get('enfant'));
        return $this->render('SLDashbordBundle:Dashbord:interroDevoirs.html.twig', array('lesNotes' => $lesNotes));
    }
    
     //methode pour afficher la vue professeurs selon un eleve
    public function professeursEleveAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        
        //recuperation des jours
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:ProfesseurMatiere');
        $lesProfesseurs=$repository->getProfesseurMatiereByEleve($session->get('enfant'));
        return $this->render('SLDashbordBundle:Dashbord:listProfesseur.html.twig', array('lesProfesseurs' => $lesProfesseurs));
    }
}
