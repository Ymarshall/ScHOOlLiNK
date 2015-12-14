<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\DashbordBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
/**
 * Description of SLGetMatiereService
 *
 * @author Meledje
 */
class SLGetMatiereService extends \Twig_Extension {

    protected $doctrine;

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine) {
        $this->doctrine = $doctrine;
    }

    public function getMatieres($id) {
        //recuperation des type de notes
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Matiere');
        $lesMatieres = $repository->getMatieresByUser($id);
        return $lesMatieres;
    }
    //recuperer la classe de l'eleve connecté
    public function getClasse($id) {
        //recuperation de la classe
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Classe');
        $laClasse = $repository->getUserClasse($id);
        return $laClasse;
    }
    //recuperer le statut de celui qui est connecté
    public function getStatut($id) {
        //recuperation du statut
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Statut');
        $leStatut = $repository->getUserStatut($id);
        return $leStatut;
    }
    //recuperer l'annee scolaire courante
    public function getAnnee() {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Annee_scolaire');
        $lannee = $repository->getAnneeScolaire();
        return $lannee;
    }
    
    //recuperer les classes du professeur qui est connecté
    public function getClasseProfesseur($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Classe');
        $lesClasses = $repository->getClasseProfesseur($id);
        return $lesClasses;
    }
    
    //recuperer les matieres du professeur qui est connecté dans une classe donnée
    public function getMatiereByProf($idC,$idP) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Matiere');
        $lesMatieres = $repository->getMatiereProf($idC,$idP);
        return $lesMatieres;
    }

    //recuperer les notes de l'eleve en fonction de sa matiere
    public function getNotesByUserAndMatiere($idU,$idM) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Notes');
        $lesNotes = $repository->getNotesByUserAndMatiere($idU,$idM);
        return $lesNotes;
    }
    
    //recuperer les classes d'une ecole en focntion du directeur qui est connecté
    public function getClasseDirecteur($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Classe');
        $lesClasses = $repository->getClasseDirecteur($id);
        return $lesClasses;
    }
    
    //recuperer l'effectif d'une classe
    public function getClasseEffectif($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Classe');
        $effectif = $repository->getEffectifClasse($id);
        return $effectif;
    }
    
    //recuperer les matieres d'une classe
    public function getMatiereByClasse($idC) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Matiere');
        $lesMatieres = $repository->getMatiereByClasse($idC);
        return $lesMatieres;
    }
    
    //recuperer les attributions du professeur qui est connecté dans une classe donnée
    public function getAttributionByClasse($idC,$idP) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:ProfesseurMatiere');
        $lesAttributions = $repository->getAttributionByClasse($idC,$idP);
        return $lesAttributions;
    }
    
    //recuperer les details du carnet de correspondance d'un eleve en fction d'un type
    public function getDetailsCrByTypeAndEleve($idT,$idE) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Details_cr');
        $lesDetails = $repository->getDetailsCrByTypeAndEleve($idT,$idE);
        return $lesDetails;
    }
    
    //recuperer les details du carnet de correspondance d'un user en fction d'un type
    public function getDetailsCrByTypeAndUser($idT,$idU) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Details_cr');
        $lesDetails = $repository->getDetailsCrByTypeAndUser($idT,$idU);
        return $lesDetails;
    }
    
    //recuperer les nombre de messages non lus
    public function getNbombreMsgNonLuByUser($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $nbre = $repository->getNbombreMsgNonLuByUser($id);
        return $nbre;
    }
    
    //recuperer les derniers  messages non lus
    public function getLastReceivedMsgByUser($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $msg = $repository->getLastReceivedMsgByUser($id);
        return $msg;
    }
    
    //recuperer le nombre d'absence 
    public function getNombreAbsence($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Details_cr');
        $nbre = $repository->getNombreAbsence($id);
        return $nbre;
    }
     //recuperer les examens de cette année et de l'ecole en cours
    public function getExamens($idA,$idE) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Examen');
        $examens = $repository->getExamens($idA,$idE);
        return $examens;
    }
    
      //recuperer les examens de cette annee et de l'eleve concerné
    public function getExamenByUser($idA,$idE) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Examen');
        $examens = $repository->getExamenByUser($idA,$idE);
        return $examens;
    }
    
      //recuperer les examens de cette annee et de l'eleve concerné
    public function getComposantByJour($idJ,$idU) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Composant');
        $composant = $repository->getComposantByJour($idJ,$idU);
        return $composant;
    }
    
     //recuperer les examens de cette annee et de l'eleve concerné
    public function getComposantByJours($idJ,$idU) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Composant');
        $composant = $repository->getComposantByJour2($idJ,$idU);
        return $composant;
    }
    
    //recuperer les examens de cette annee et de l'eleve concerné
    public function getClasseByComposant($id) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Classe');
        $classe = $repository->getClasseByComposant($id);
        return $classe;
    }
    
    //recuperer l'emploi du temps d'une classe
    public function getComposantByClasse($idJ,$idC) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Composant');
        $composant = $repository->getComposantByClasse($idJ,$idC);
        return $composant;
    }
    
    //recuperer l'emploi du temps d'une classe
    public function getProfesseurMatiere($idM,$idC) {
        $repository = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Professeur');
        $prof = $repository->getProfesseurMatiere($idM,$idC);
        return $prof;
    }
    
    //rfonction pour initialiser les variables sessions et autres
    public function initialise($ident,$statut,Request $request) {
        //recuperation de l'ecole
         $repositoryEcole = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Ecole');
         //recuperation de l'annee
         $repositoryAnnee = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Annee_scolaire');
        //creation de la variable session ecole
        $session=$request->getSession();
        $session->set('ecole_courante',$repositoryEcole->getEcoleByUser($ident)->getId());
        $session->set('annee_courante', $repositoryAnnee->getAnneeScolaire()->getId());
        if($statut=="parent"){
        //recuperation de l'enfant (eleve)
            $repositoryEleve = $this->doctrine->getManager()->getRepository('SLPlateformBundle:Eleve');
            $lEnfant=$repositoryEleve->getChild($ident);
             //creation de la variable session de l'enfant
            $session->set('enfant', $lEnfant->getPersonne()->getId());
        }
        return false;
    }
    
    public function getFunctions() {
        return array(
            'getMatiereByUser' => new \Twig_Function_Method($this, 'getMatieres'),
            'getUserClasse' => new \Twig_Function_Method($this, 'getClasse'),
            'getUserStatut' => new \Twig_Function_Method($this, 'getStatut'),
            'getAnneeScolaire' => new \Twig_Function_Method($this, 'getAnnee'),
            'getClasseProfesseur' => new \Twig_Function_Method($this, 'getClasseProfesseur'),
            'getMatiereByProf' => new \Twig_Function_Method($this, 'getMatiereByProf'),
            'getNotesByUserAndMatiere' => new \Twig_Function_Method($this, 'getNotesByUserAndMatiere'),
            'getClasseDirecteur' => new \Twig_Function_Method($this, 'getClasseDirecteur'),
            'getClasseEffectif' => new \Twig_Function_Method($this, 'getClasseEffectif'),
            'getMatiereByClasse' => new \Twig_Function_Method($this, 'getMatiereByClasse'),
            'getAttributionByClasse' => new \Twig_Function_Method($this, 'getAttributionByClasse'),
            'getDetailsCrByTypeAndEleve' => new \Twig_Function_Method($this, 'getDetailsCrByTypeAndEleve'),
            'getDetailsCrByTypeAndUser' => new \Twig_Function_Method($this, 'getDetailsCrByTypeAndUser'),
            'getNbombreMsgNonLuByUser' => new \Twig_Function_Method($this, 'getNbombreMsgNonLuByUser'),
            'getLastReceivedMsgByUser' => new \Twig_Function_Method($this, 'getLastReceivedMsgByUser'),
            'getNombreAbsence' => new \Twig_Function_Method($this, 'getNombreAbsence'),
            'getExamens' => new \Twig_Function_Method($this, 'getExamens'),
            'getExamenByUser' => new \Twig_Function_Method($this, 'getExamenByUser'),
            'getComposantByJour' => new \Twig_Function_Method($this, 'getComposantByJour'),
            'getComposantByJours' => new \Twig_Function_Method($this, 'getComposantByJours'),
            'getClasseByComposant' => new \Twig_Function_Method($this, 'getClasseByComposant'),
            'getComposantByClasse' => new \Twig_Function_Method($this, 'getComposantByClasse'),
            'getProfesseurMatiere' => new \Twig_Function_Method($this, 'getProfesseurMatiere'),
            'initialise' => new \Twig_Function_Method($this, 'initialise')
        );
    }

    // La méthode getName() identifie votre extension Twig, elle est obligatoire
    public function getName() {
        return 'SLGetMatiereService';
    }

}
