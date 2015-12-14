<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Eleve;
use SL\PlateformBundle\Form\EleveType;

/**
 * Eleve controller.
 *
 * @Route("/eleve")
 */
class EleveController extends Controller
{

    /**
     * Lists all Eleve entities.
     *
     * @Route("/", name="eleve")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Eleve')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Eleve entity.
     *
     * @Route("/", name="eleve_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Eleve:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $session=$request->getSession();
        $entity = new Eleve();
        $ecoleperso =new \SL\PlateformBundle\Entity\EcolePersonne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
             //ecole personne
            $ecoleperso->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
            $user=$entity->getPersonne();
            $user->setEnabled(true);
            $ecoleperso->setPersonne($user);
            $ecoleperso->setStatut($em->getRepository('SLPlateformBundle:Statut')->findOneBy(array('libelle'=>'Eleve')));
            
            $em->persist($entity);
            $em->persist($ecoleperso);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Inscription réussie.');
            return $this->redirect($this->generateUrl('sl_educateur_carnet', array('id' => $entity->getId())));
        }

         return $this->render('SLDashbordBundle:Educateur:ajouterEleve.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Eleve entity.
     *
     * @param Eleve $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Eleve $entity)
    {
        $form = $this->createForm(new EleveType(), $entity, array(
            'action' => $this->generateUrl('eleve_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Eleve entity.
     *
     * @Route("/new", name="eleve_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Eleve();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Eleve entity.
     *
     * @Route("/{id}", name="eleve_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Eleve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eleve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Eleve entity.
     *
     * @Route("/{id}/edit", name="eleve_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Eleve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eleve entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLDashbordBundle:Educateur:modifierEleve.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));
    }

    /**
    * Creates a form to edit a Eleve entity.
    *
    * @param Eleve $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Eleve $entity)
    {
        $form = $this->createForm(new \SL\PlateformBundle\Form\EleveEditType(), $entity, array(
            'action' => $this->generateUrl('eleve_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Eleve entity.
     *
     * @Route("/{id}", name="eleve_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Eleve:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $session=$request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Eleve')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Eleve entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

           $session->getFlashBag()->add('notice', 'modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_educateur_carnet',array('id'=>$session->get('eleve_courant'))));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Eleve entity.
     *
     * @Route("/{id}", name="eleve_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Eleve')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Eleve entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eleve'));
    }

    /**
     * Creates a form to delete a Eleve entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eleve_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
