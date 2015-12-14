<?php

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProfesseurController extends Controller{
    
        //methode pour afficher la vue de la liste des élèves d'une classe donnée
    public function listeEleveAction($nombre, Request $request)
    {        
        
            //recuperation de la classe
             $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $laClasse=$repositoryClasse->find($nombre);
            $session = $request->getSession();
            $session->set('classe_courante', $nombre);
             //recuperation de l'effectif de la classe
            $effectif=$repositoryClasse->getEffectifClasse($nombre);
            
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $lesEleves=$repository->getElevesByClasse($nombre);
        return $this->render('SLDashbordBundle:Professeur:listEleves.html.twig', array('lesEleves' => $lesEleves, 'laClasse' => $laClasse, 'effectif' => $effectif));
    }
    
       //methode pour afficher la vue du cahier de texte
    public function cahierTexteAction($classe,$matiere, Request $request)
    {   
        // Récupération de la session
    $session = $request->getSession();
    // On définit des variables sessions
    $session->set('classe_courante', $classe);
    $session->set('matiere_courante', $matiere);
         //recuperation de la matiere
             $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
            $laMatiere=$repositoryMatiere->find($matiere);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Details_ct');
        $lesDetails=$repository->getDetailsCt($matiere,$classe);
        return $this->render('SLDashbordBundle:Professeur:cahierText.html.twig', array('lesDetails' => $lesDetails, 'laMatiere' => $laMatiere));
    }
    
      //methode pour afficher la vue des cours et exo
    public function coursExoAction($classe,$matiere, Request $request)
    {   
        // Récupération de la session
    $session = $request->getSession();
    // On définit une nouvelle valeur pour cette variable user_id
    $session->set('classe_courante', $classe);
    $session->set('matiere_courante', $matiere);
         //recuperation de la matiere
             $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
            $laMatiere=$repositoryMatiere->find($matiere);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Cours_exo');
        $lesDetails=$repository->getCoursExo($matiere,$classe);
        return $this->render('SLDashbordBundle:Professeur:coursExo.html.twig', array('lesFichiers' => $lesDetails, 'laMatiere' => $laMatiere));
    }
    
     //methode pour afficher la vue des devoirs et interro
    public function devoirsInterroAction($classe,$matiere, Request $request)
    {   
     // Récupération de la session
    $session = $request->getSession();
    // On définit une nouvelle valeur pour cette variable user_id
    $session->set('classe_courante', $classe);
    $session->set('matiere_courante', $matiere);
    
    //recuperation de la matiere
    $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
    $laMatiere=$repositoryMatiere->find($matiere);
    
     //recuperation de la classe
    $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
    $laClasse=$repositoryClasse->find($classe);
    
    //recuperation de la liste de la classe
    $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $effectifs=$repository->getElevesByClasse($classe);
    
    //recuperation de l'effectif de la classe
    $effectif=$repositoryClasse->getEffectifClasse($classe);
        
        return $this->render('SLDashbordBundle:Professeur:devoirsInterro.html.twig', array('lesEleves' => $effectifs, 'laMatiere' => $laMatiere, 'laClasse' => $laClasse, 'effectif' => $effectif));
    }
}
