<?php

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SL\PlateformBundle\Entity\ProfesseurMatiere;
use SL\PlateformBundle\Form\ProfesseurMatiereType;

class AdminController extends Controller{
        //methode pour afficher la vue de la liste des élèves d'une classe donnée
    public function listClasseAction()
    {     
        //recuperation de l'identifiant du user
         $user = $this->container->get('security.context')->getToken()->getUser();
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
        $lesClasses=$repository->getClasseDirecteur($user->getId());
        return $this->render('SLDashbordBundle:Administrateur:listClasse.html.twig', array('lesClasses' => $lesClasses));
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
          
             //recuperation de la matiere
             $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $laClasse=$repositoryClasse->find($classe);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Details_ct');
        $lesDetails=$repository->getDetailsCt($matiere,$classe);
        return $this->render('SLDashbordBundle:Administrateur:cahierText.html.twig', array('lesDetails' => $lesDetails, 'laMatiere' => $laMatiere, 'laClasse'=>$laClasse));
    }
    
     //methode pour afficher la vue de la liste des professeurs
    public function professeursListAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Professeur');
        $lesProfesseurs=$repository->getProfesseursBySchool($ident);
        return $this->render('SLDashbordBundle:Administrateur:listProfesseur.html.twig', array('lesProfesseurs' => $lesProfesseurs));
    }
    
     //methode pour afficher la vue de la liste des professeurs
    public function educateursListAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Educateur');
        $lesEducateurs=$repository->getEducateursBySchool($ident);
        return $this->render('SLDashbordBundle:Administrateur:listEducateur.html.twig', array('lesEducateurs' => $lesEducateurs));
    }
    
    //methode pour afficher la vue de voir professeur
    public function voirProfesseurAction(Request $request,$id)
    {   
        //creation de la variable session
        $session=$request->getSession();
        $session->set('professeur_courant', $id);

//recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
         //recuperont son statut dans cette ecole
        $repositoryEcoleProf = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:EcoleProfesseur');
        $leStatut=$repositoryEcoleProf->getProfEcol($id,$ident);
        
        //recuperons le nombre de classe dans lesquelles il donne cours dans cette ecole
        $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
        $nombreClasse=$repositoryClasse->getNombreClasseProfesseur($id);
        
        //recuperons le nombre de matières qu'il dispense dans cette ecole
        $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
        $nombreMatiere=$repositoryMatiere->getNombreMatiereProfesseur($id);
        
        //recuperons les classes du professeur
        $lesClasses=$repositoryClasse->getClassesProf($id);
        
        //formulaire d'attribution
        $entity = new ProfesseurMatiere();
        //remplissons la methode set Professeur
        $entity->setProfesseur($this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Professeur')->find($id));
        $form   = $this->createCreateForm($entity);
        
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Professeur');
        $leProfesseur=$repository->find($id);
        return $this->render('SLDashbordBundle:Administrateur:voirProfesseur.html.twig', array('leProfesseur' => $leProfesseur,'leStatut'=>$leStatut,'nombreClasse'=>$nombreClasse,'nombreMatiere'=>$nombreMatiere,'entity' => $entity,
            'form'   => $form->createView(),'lesClasses'=>$lesClasses));
    }
    
    //methode pour afficher la vue de voir professeur
    public function voirEducateurAction(Request $request,$id)
    {   
        //creation de la variable session
      //  $session=$request->getSession();
      //  $session->set('educateur_courant', $id);

          //recuperation de l'identifiant du user (directeur)
          //  $user = $this->container->get('security.context')->getToken()->getUser();
          //  $ident=$user->getId();

        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Educateur');
        $lEducateur=$repository->find($id);
        return $this->render('SLDashbordBundle:Administrateur:voirEducateur.html.twig', array('lEducateur' => $lEducateur));
    }
    
    //methode pour afficher la vue de voir professeur
    public function listExamenAction(Request $request)
    {   
        //creation de la variable session
        $session=$request->getSession();

          //recuperation de l'identifiant du user (directeur)
          //  $user = $this->container->get('security.context')->getToken()->getUser();
          //  $ident=$user->getId();

        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Examen');
        $lesExamens=$repository->getExamensBySchool($session->get('ecole_courante'));
        return $this->render('SLDashbordBundle:Administrateur:listExamen.html.twig', array('lesExamens' => $lesExamens));
    }
    
    
    //formulaire d'attribution
    private function createCreateForm(ProfesseurMatiere $entity)
    {
        $form = $this->createForm(new ProfesseurMatiereType(), $entity, array(
            'action' => $this->generateUrl('professeurmatiere_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Attribuer'));

        return $form;
    }
}
