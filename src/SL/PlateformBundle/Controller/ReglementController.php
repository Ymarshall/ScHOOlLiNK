<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Reglement;
use SL\PlateformBundle\Form\ReglementType;

/**
 * Reglement controller.
 *
 * @Route("/reglement")
 */
class ReglementController extends Controller
{

    /**
     * Lists all Reglement entities.
     *
     * @Route("/", name="reglement")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Reglement')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Reglement entity.
     *
     * @Route("/", name="reglement_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Reglement:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        
         //recuperons la classe
         $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Classe');
        $classe = $repository->find($session->get('classe'));
        
        $entity = new Reglement();
        $entity->setClasse($classe);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

             $session->getFlashBag()->add('notice', 'Ligne ajoutée avec succès.');
            return $this->redirect($this->get('router')->generate('sl_admin_scolarite_classe',array('id'=>$session->get('classe'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Reglement entity.
     *
     * @param Reglement $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Reglement $entity)
    {
        $form = $this->createForm(new ReglementType(), $entity, array(
            'action' => $this->generateUrl('reglement_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Reglement entity.
     *
     * @Route("/new", name="reglement_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Reglement();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Reglement entity.
     *
     * @Route("/{id}", name="reglement_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reglement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Reglement entity.
     *
     * @Route("/{id}/edit", name="reglement_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reglement entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

                return $this->render('SLDashbordBundle:Administrateur:ajouterReglement.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));

    }

    /**
    * Creates a form to edit a Reglement entity.
    *
    * @param Reglement $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Reglement $entity)
    {
        $form = $this->createForm(new ReglementType(), $entity, array(
            'action' => $this->generateUrl('reglement_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Reglement entity.
     *
     * @Route("/{id}", name="reglement_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Reglement:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $entity = $em->getRepository('SLPlateformBundle:Reglement')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Reglement entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

             $session->getFlashBag()->add('notice', 'Modification éffectuée.');
            return $this->redirect($this->get('router')->generate('sl_admin_scolarite_classe',array('id'=>$session->get('classe'))));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Reglement entity.
     *
     * @Route("/{id}", name="reglement_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $session=$request->getSession();

      //  if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Reglement')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Reglement entity.');
            }

            $em->remove($entity);
            $em->flush();
       // }

         $session->getFlashBag()->add('notice', 'Suppression réussie.');
            return $this->redirect($this->get('router')->generate('sl_admin_scolarite_classe',array('id'=>$session->get('classe'))));
    }

    /**
     * Creates a form to delete a Reglement entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reglement_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
