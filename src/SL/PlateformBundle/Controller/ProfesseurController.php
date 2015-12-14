<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Professeur;
use SL\PlateformBundle\Form\ProfesseurType;
use SL\PlateformBundle\Entity\EcoleProfesseur;
use SL\PlateformBundle\Entity\EcolePersonne;
use SL\PlateformBundle\Entity\User;

/**
 * Professeur controller.
 *
 * @Route("/professeur")
 */
class ProfesseurController extends Controller
{

    /**
     * Lists all Professeur entities.
     *
     * @Route("/", name="professeur")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Professeur')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Professeur entity.
     *
     * @Route("/", name="professeur_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Professeur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        $entity = new Professeur();
        $ecoleProf = new EcoleProfesseur();
          $ecoleperso =new EcolePersonne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $statut=$request->get('statut');
            //ecole professeur
            $ecoleProf->setProfesseur($entity);
            $ecoleProf->setStatut($statut);
            $ecoleProf->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
            
            //ecole personne
            $ecoleperso->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
            $user=$entity->getPersonne();
            $user->setEnabled(true);
            $ecoleperso->setPersonne($user);
            $ecoleperso->setStatut($em->getRepository('SLPlateformBundle:Statut')->findOneBy(array('libelle'=>'Professeur')));
            
            $em->persist($entity);
            $em->persist($ecoleProf);
            $em->persist($ecoleperso);
            $em->flush();

          $request->getSession()->getFlashBag()->add('notice', 'Professeur ajouté avec succès.');
            return $this->redirect($this->get('router')->generate('sl_admin_professeur_list'));
        }
        return $this->render('SLDashbordBundle:Administrateur:ajoutProfesseur.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Professeur entity.
     *
     * @param Professeur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Professeur $entity)
    {
        $form = $this->createForm(new ProfesseurType(), $entity, array(
            'action' => $this->generateUrl('professeur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Professeur entity.
     *
     * @Route("/new", name="professeur_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Professeur();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Professeur entity.
     *
     * @Route("/{id}", name="professeur_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Professeur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Professeur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Professeur entity.
     *
     * @Route("/{id}/edit", name="professeur_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Professeur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Professeur entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLDashbordBundle:Administrateur:modifierProfesseur.html.twig',array('entity' => $entity,'form'   => $editForm->createView()));
    }

    /**
    * Creates a form to edit a Professeur entity.
    *
    * @param Professeur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Professeur $entity)
    {
        $form = $this->createForm(new \SL\PlateformBundle\Form\ProfesseurEditType(), $entity, array(
            'action' => $this->generateUrl('professeur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Professeur entity.
     *
     * @Route("/{id}", name="professeur_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Professeur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Professeur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Professeur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_admin_professeur_list'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Professeur entity.
     *
     * @Route("/{id}", name="professeur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
 //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
       // if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Professeur')->find($id);
            //recuperont les ecoles professeurs
            $ecoleprof=$em->getRepository('SLPlateformBundle:EcoleProfesseur')->getProfEcol($id,$ident);
            
            //recuperont les professeurs matieres
            $ecolemat=$em->getRepository('SLPlateformBundle:ProfesseurMatiere')->getProfMatiere($id);
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Professeur entity.');
            }
            
                $em->remove($ecoleprof);
            
            foreach ($ecolemat as $ec) {
                $em->remove($ec);
            }
            $em->remove($entity);
            $em->flush();
       // }

        return $this->redirect($this->generateUrl('professeur'));
    }

    /**
     * Creates a form to delete a Professeur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('professeur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
