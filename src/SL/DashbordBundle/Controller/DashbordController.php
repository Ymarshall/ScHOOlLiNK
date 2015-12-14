<?php

namespace SL\DashbordBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SL\PlateformBundle\Entity\Information;
use \SL\PlateformBundle\Form\InformationType;

use SL\PlateformBundle\Entity\EleveExamen;
use SL\PlateformBundle\Form\EleveExamenType;
use SL\PlateformBundle\Entity\Composant;
use SL\PlateformBundle\Form\ComposantType;
use SL\PlateformBundle\Entity\Reglement;
use SL\PlateformBundle\Form\ReglementType;

class DashbordController extends Controller
{
    public function indexAction(Request $request)
    {
        //creation du formulaire d'envoi d'information directeur et l'educateur
        $entity = new Information();
        $form = $this->createCreateForm($entity);
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
         //recuperation de l'ecole
         $repositoryEcole = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Ecole');
        
        if($this->get('security.context')->isGranted('ROLE_ELEVE')){
            //recuperation des infos pour eleves
           $repositoryInfo = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Information');
        $lesInfos=$repositoryInfo->getElevesInfos();
        
            //recuperation de la plus forte note et plus faible note (devoir)
            $repositoryNote = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Notes');
            $forteNote=$repositoryNote->getForteNote($ident);
            $faibleNote=$repositoryNote->getFaibleNote($ident);
            
            //recuperation des jours
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Jour');
        $lesJours=$repository->getJoursByEleve($ident);
        return $this->render('SLDashbordBundle:Dashbord:index.html.twig', array('lesJours' => $lesJours,'lesInfos'=>$lesInfos,'faibleNote' => $faibleNote,'forteNote'=>$forteNote));
        }
        elseif($this->get('security.context')->isGranted('ROLE_PROFESSEUR')){
            //recuperation des jours
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Jour');
        $lesJours=$repository->getJoursOuvrables();
        
            //recuperation des infos pour eleves
           $repositoryInfo = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Information');
        $lesInfos=$repositoryInfo->getProfesseursInfos();
        return $this->render('SLDashbordBundle:Professeur:indexProfesseur.html.twig',array('lesJours' => $lesJours,'lesInfos'=>$lesInfos));
        }
        elseif($this->get('security.context')->isGranted('ROLE_ADMIN')){
            //nombre de classe
            $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $nombreClasse=$repositoryClasse->getNombreClasseByEcole($repositoryEcole->getEcoleByUser($ident)->getId());
            //nombre de professeur
            $repositoryProf = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Professeur');
            $nombreProf=$repositoryProf->getNombreProfByEcole($repositoryEcole->getEcoleByUser($ident)->getId());
            //nombre d'eleves
            $repositoryEleve = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
            $nombreEleve=$repositoryEleve->getNombreEleveByEcole($repositoryEcole->getEcoleByUser($ident)->getId());
            
        return $this->render('SLDashbordBundle:Administrateur:indexAdmin.html.twig', array('entity' => $entity,
            'form'   => $form->createView(),'nombreClasse'   => $nombreClasse,'nombreProf'   => $nombreProf,'nombreEleve'   => $nombreEleve));
        }  elseif($this->get('security.context')->isGranted('ROLE_EDUCATEUR')){
            return $this->render('SLDashbordBundle:Educateur:indexEducateur.html.twig');
        }else{
            //recuperation de l'enfant (eleve)
            $repositoryEleve = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
            $lEnfant=$repositoryEleve->getChild($ident);
            
              //recuperation des infos pour eleves
           $repositoryInfo = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Information');
           $lesInfos=$repositoryInfo->getParentsInfos();
           
            //recuperation des jours
            $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Jour');
            $lesJours=$repository->getJoursByEleve($lEnfant->getPersonne()->getId());
            
            //recuperation de la plus forte note et plus faible note (devoir)
            $repositoryNote = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Notes');
            $forteNote=$repositoryNote->getForteNote($lEnfant->getPersonne()->getId());
            $faibleNote=$repositoryNote->getFaibleNote($lEnfant->getPersonne()->getId());
            
            return $this->render('SLDashbordBundle:Parent:indexParent.html.twig',array('lesJours' => $lesJours,'lesInfos'=>$lesInfos,'faibleNote' => $faibleNote,'forteNote'=>$forteNote));
        }
            
    }
    //methode pour afficher la vue professeurs selon un eleve
    public function professeursEleveAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();

        //recuperation des jours
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:ProfesseurMatiere');
        $lesProfesseurs=$repository->getProfesseurMatiereByEleve($ident);
        return $this->render('SLDashbordBundle:Dashbord:listProfesseur.html.twig', array('lesProfesseurs' => $lesProfesseurs));
    }
    
    //methode pour afficher la vue d'information sur l'école
    public function ecoleAction(Request $request)
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
       
        //recuperation de l'ecole
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Ecole');
        
            $lEcole=$repository->getEcoleByUser($ident);
        
        //recuperation du directeur
        $repositoryU = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:User');
        $directeur=$repositoryU->getDirecteur($lEcole->getId());
        return $this->render('SLDashbordBundle:Dashbord:affichageEcole.html.twig', array('lEcole' => $lEcole,'directeur'=>$directeur));
    }
    
     //methode pour afficher la vue du carnet de correspondance d'un eleve
    public function carnetCorrespondanceAction(Request $request)
    {    
        $session = $request->getSession();
         $id=0;
          //recuperation de l'éleve
        $repositoryEleve = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        if($session->get('enfant')){
        $lEleve=$repositoryEleve->find($session->get('enfant'));
        $id=$session->get('enfant');
        }else{
            //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            $lEleve=$repositoryEleve->find($ident);
            $id=$ident;
        }
        
       
         //recuperation des type de details cr
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Type_details_cr');
        $lesTypes=$repository->getTypeDetailsByUser($id);
        return $this->render('SLDashbordBundle:Dashbord:carnetCorrespondance.html.twig', array('lesTypes' => $lesTypes,'lEleve' => $lEleve ));
    }
        //methode pour afficher la vue des interro et devoirs
    public function interroDevAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();

        //recuperation des type de notes
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Type_note');
        $lesNotes=$repository->getTypeNotesByUser($ident);
        return $this->render('SLDashbordBundle:Dashbord:interroDevoirs.html.twig', array('lesNotes' => $lesNotes));
    }
    
        //methode pour afficher la vue du carnet de correspondance
    public function cahierTextAction($nombre)
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
            //recuperation de la matiere
             $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
            $laMatiere=$repositoryMatiere->find($nombre);
        //recuperation du contenu du cahier de text de la matiere $id et de la classe getUserClasse
            //recuperons la classe
            $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $laClasse=$repositoryClasse->getUserClasse($ident);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Details_ct');
        $lesDetails=$repository->getDetailsCt($nombre, $laClasse->getId());
        return $this->render('SLDashbordBundle:Dashbord:cahierText.html.twig', array('lesDetails' => $lesDetails, 'laMatiere' => $laMatiere));
    }
    
         //methode pour afficher la vue de la liste des cours et exercices
    public function coursExoAction($nombre)
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
            //recuperation de la matiere
             $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
            $laMatiere=$repositoryMatiere->find($nombre);
        //recuperation du contenu du cahier de text de la matiere $id et de la classe getUserClasse
            //recuperons la classe
            $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
            $laClasse=$repositoryClasse->getUserClasse($ident);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Cours_exo');
        $lesFichiers=$repository->getCoursExo($nombre, $laClasse->getId());
        return $this->render('SLDashbordBundle:Dashbord:coursExo.html.twig', array('lesFichiers' => $lesFichiers, 'laMatiere' => $laMatiere));
    }
    
     //methode pour afficher la vue de la liste des professeurs
    public function professeursListAction()
    {
         //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Professeur');
        $lesProfesseurs=$repository->getProfesseursBySchool($ident);
        return $this->render('SLDashbordBundle:Dashbord:listProfesseurGlobal.html.twig', array('lesProfesseurs' => $lesProfesseurs));
    }
    
     //methode pour afficher la vue de la liste des educateur
    public function educateursListAction()
    {
         //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Educateur');
        $lesEducateurs=$repository->getEducateursBySchool($ident);
        return $this->render('SLDashbordBundle:Dashbord:listEducateurGlobal.html.twig', array('lesEducateurs' => $lesEducateurs));
    }
    
     //methode pour afficher la vue des messages recus
    public function messageAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        //recuperer le nombre total des messages
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $nbreTotal=$repository->getNbombreMsgTotalByUser($ident);
        
         //recuperer le nombre total des messages envoyés
        $repositorySM = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Message');
        $nbreSend=$repositorySM->getNbreSendMsgByUser($ident);
            
        $lesMessages=$repository->getReceivedMsgByUser($ident);
        return $this->render('SLDashbordBundle:Dashbord:messages.html.twig', array('lesMessages' => $lesMessages,'total'=>$nbreTotal,'totalSend'=>$nbreSend));
    }
    
    //methode pour afficher la vue des messages envoyes
    public function messageEnvoyesAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
         
            //recuperer le nombre total des messages
        $repositoryMP = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $nbreTotal=$repositoryMP->getNbombreMsgTotalByUser($ident);
        
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Message');
        $nbreSend=$repository->getNbreSendMsgByUser($ident);
        $lesMessages=$repository->getSendMsgByUser($ident);
        return $this->render('SLDashbordBundle:Dashbord:messagesEnvoyes.html.twig', array('lesMessages' => $lesMessages,'total'=>$nbreTotal,'totalSend'=>$nbreSend));
    }
    
     //methode pour afficher la vue de lire message
    public function lireMessageAction($id)
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
        //changer le statut du message
            //recuperons le message_personne
            $repositoryMP = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $leMessageP=$repositoryMP->findOneBy(array('message'=>$id,'personne'=>$ident));
            if(!$leMessageP->getStatut()){
                $leMessageP->setStatut(true);
                $this->getDoctrine()->getManager()->flush();
            }
           //recuperer le nombre total des messages
        $repositoryMP = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $nbreTotal=$repositoryMP->getNbombreMsgTotalByUser($ident);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Message');
        $nbreSend=$repository->getNbreSendMsgByUser($ident);
        $leMessage=$repository->find($id);
        return $this->render('SLDashbordBundle:Dashbord:lireMessage.html.twig', array('leMessage' => $leMessage,'total'=>$nbreTotal,'totalSend'=>$nbreSend));
    }
    
    //methode pour afficher la vue des messages
    public function composeAction()
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
          //recuperer le nombre total des messages
        $repositoryMP = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Messages_personne');
        $nbreTotal=$repositoryMP->getNbombreMsgTotalByUser($ident);
            
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Message');
        $nbreSend=$repository->getNbreSendMsgByUser($ident);
        return $this->render('SLDashbordBundle:Dashbord:compose.html.twig',array('total'=>$nbreTotal,'totalSend'=>$nbreSend));
    }
    
     //methode pour afficher la vue des messages
    public function supprimerMessageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
          $messages=$request->get('chksup');
          foreach ($messages as $value) {
                $repositoryMP = $em->getRepository('SLPlateformBundle:Messages_personne');
                $leMsg=$repositoryMP->find($value);
                $em->remove($leMsg);
        }
            $em->flush();
        return $this->redirect($this->generateUrl('sl_dashbord_message'));
    }
    
    private function createCreateForm(Information $entity)
    {
        $form = $this->createForm(new InformationType(), $entity, array(
            'action' => $this->generateUrl('information_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Envoyer'));

        return $form;
    }
       
     //methode pour afficher la vue de profile
    public function profileAction()
    {            
        return $this->render('SLDashbordBundle:Dashbord:profile.html.twig');
    }
    
    //methode pour afficher la vue de modification de mot de passe
    public function modifierPassAction(Request $request)
    {
       
   
        return $this->render('SLDashbordBundle:Dashbord:modifierPass.html.twig');
    }
    
     //methode pour afficher la vue d'ajout d'une note d'examen blanc
    public function examenBlancListAction(Request $request, $id)
    {

        //variable session pour l'examen
        $session=$request->getSession();
        $session->set('examen', $id);
        
        //recuperation de l'examen
         $repositoryE = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Examen');
         $lExamen=$repositoryE->find($id);
         
       
        //recuperation des eleves  des classes concernees par un examen
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        //nombre de personnes concernées
        $effectif=$repository->getNombrePersonnes($id);
       $lesEleves=$repository->getElevesByExamen($id);
        return $this->render('SLDashbordBundle:Professeur:examenBlancList.html.twig', array('lesEleves' => $lesEleves,'lExamen' => $lExamen,'effectif'=>$effectif));
    }
    //methode pour afficher la vue d'ajout d'une note d'examen blanc
    public function examenBlancAjouterAction(Request $request, $eleve)
    {
        
        //variable session pour l'examen
        $session=$request->getSession();
        $session->set('eleve_courant', $eleve);
        
        //creation du formulaire d'ajout de note d'examen
        $entity2 = new EleveExamen();
        $form2 = $this->createCreateForm3($entity2,$request);
        
        
        return $this->render('SLDashbordBundle:Professeur:ajoutNoteExamen.html.twig', array('form2' => $form2->createView()));
    }
   
     //methode pour afficher la vue de voir d'un eleve d'examen blanc
    public function examenBlancVoirAction(Request $request, $id)
    {
        
        //variable session pour l'examen
        $session=$request->getSession();
        
        
        //recuperation de l'examen
        $repositoryEx = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Examen');
        $lExamen=$repositoryEx->find($session->get('examen'));
        //recuperation de l'eleve
        $repositoryEl = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $lEleve=$repositoryEl->find($id);
        //recuperation des notes
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:EleveExamen');
        $lesNotes=$repository->getElevesByExamen($session->get('examen'),$id);
        $total=0;
        $totalCoef=0;
        //calcule du nombre de points total
        foreach ($lesNotes as $note) {
                $total+=($note->getNote()*$note->getCoefficient());
                $totalCoef+=$note->getCoefficient();
            }
            //moyenne
            $moyenne=$total/$totalCoef;
            //mention
            $mention="";
            if($moyenne>=10 && $moyenne<12){
                $mention.="passable";
            }elseif($moyenne>=12 && $moyenne<15){
                $mention.="assez-bien";
            }elseif($moyenne>=15 && $moyenne<17){
                $mention.="bien";
            }elseif($moyenne>=17){
                $mention.="très-bien";
            }else{
                $mention.="";
            }
        return $this->render('SLDashbordBundle:Professeur:voirNote.html.twig', array('lesNotes'=>$lesNotes,'lEleve'=>$lEleve,'lExamen'=>$lExamen,'totalPoint'=>$total,'moyenne'=>$moyenne,'mention'=>$mention));
    }
    
    //methode pour afficher la vue de voir d'un eleve d'examen blanc
    public function examenClientAction(Request $request, $id,$examen)
    {
   
        
        //recuperation de l'examen
        $repositoryEx = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Examen');
        $lExamen=$repositoryEx->find($examen);
        //recuperation de l'eleve
        $repositoryEl = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $lEleve=$repositoryEl->find($id);
        //recuperation des notes
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:EleveExamen');
        $lesNotes=$repository->getElevesByExamen($examen,$id);
        $total=0;
        $totalCoef=0;
        //calcule du nombre de points total
        foreach ($lesNotes as $note) {
                $total+=($note->getNote()*$note->getCoefficient());
                $totalCoef+=$note->getCoefficient();
            }
            //moyenne
            $moyenne=$total/$totalCoef;
            //mention
            $mention="";
            if($moyenne>=10 && $moyenne<12){
                $mention.="passable";
            }elseif($moyenne>=12 && $moyenne<15){
                $mention.="assez-bien";
            }elseif($moyenne>=15 && $moyenne<17){
                $mention.="bien";
            }elseif($moyenne>=17){
                $mention.="très-bien";
            }else{
                $mention.="";
            }
        return $this->render('SLDashbordBundle:Professeur:voirNote.html.twig', array('lesNotes'=>$lesNotes,'lEleve'=>$lEleve,'lExamen'=>$lExamen,'totalPoint'=>$total,'moyenne'=>$moyenne,'mention'=>$mention));
    }
    
    private function createCreateForm3(EleveExamen $entity, Request $request)
    {
        $session=$request->getSession();
        $form = $this->createForm(new EleveExamenType(), $entity, array(
            'action' => $this->generateUrl('eleveexamen_create'),
            'method' => 'POST','post_max_size_message'=> $session->get('examen'),
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }
    
      //methode pour afficher la vue emploi du temps
    public function emploiTempsAction(Request $request,$id)
    {
        $session=$request->getSession();
        $session->set('classe', $id);
        
        //recuperation des jours
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Jour');
        $lesJours=$repository->getJours();
        return $this->render('SLDashbordBundle:Dashbord:emploiTemps.html.twig', array('lesJours' => $lesJours));
    }
    
      //methode pour afficher la vue emploi du temps
    public function ajouterComposantAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $session->set('jour',$id);
        
        $entity = new Composant();
        $entity->setJour($em->getRepository('SLPlateformBundle:Jour')->find($id));
        $entity->setEmploitemps($em->getRepository('SLPlateformBundle:Classe')->find($session->get('classe'))->getEmploiTemps());
        $form = $this->createCreateFormComposant($entity);
        $form->handleRequest($request);
        return $this->render('SLDashbordBundle:Educateur:ajouterComposant.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }
    
    private function createCreateFormComposant(Composant $entity)
    {
        $form = $this->createForm(new ComposantType(), $entity, array(
            'action' => $this->generateUrl('composant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }
    
      //methode pour afficher la vue emploi du temps
    public function listeScolariteAction(Request $request,$id)
    {
        $session=$request->getSession();
        $session->set('classe', $id);
        
        //recuperation des reglements en focntion de la classe
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Reglement');
        $lesReglements=$repository->getReglements($id);
        
        //recuperation des frais en focntion de la classe
        $lesFrais=$repository->getFrais($id);
        return $this->render('SLDashbordBundle:Administrateur:listScolarite.html.twig', array('lesFrais' => $lesFrais,'lesReglements'=>$lesReglements));
    }
    
     //methode pour afficher la vue emploi du temps
    public function listeScolariteBisAction($id)
    {
        //recuperation de la classe
        $repositoryClasse = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $classe=$repositoryClasse->find($id)->getClasse();
        //recuperation des reglements en focntion de la classe
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Reglement');
        $lesReglements=$repository->getReglements($classe->getId());
        
        //recuperation des frais en focntion de la classe
        $lesFrais=$repository->getFrais($classe->getId());
        return $this->render('SLDashbordBundle:Administrateur:listScolarite.html.twig', array('lesFrais' => $lesFrais,'lesReglements'=>$lesReglements));
    }
    
      //methode pour afficher la vue emploi du temps
    public function addScolariteAction(Request $request,$type)
    {
        $em = $this->getDoctrine()->getManager();
       
        $entity = new Reglement();
        $entity->setTypeReglement($em->getRepository('SLPlateformBundle:Type_reglement')->findOneBy(array('libelle'=>$type)));
        $form = $this->createCreateFormSco($entity);
        $form->handleRequest($request);
        return $this->render('SLDashbordBundle:Administrateur:ajouterReglement.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }
    
    private function createCreateFormSco(Reglement $entity)
    {
        $form = $this->createForm(new ReglementType(), $entity, array(
            'action' => $this->generateUrl('reglement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }
}
