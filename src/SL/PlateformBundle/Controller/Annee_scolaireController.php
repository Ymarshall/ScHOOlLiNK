<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Annee_scolaire;
use SL\PlateformBundle\Form\Annee_scolaireType;

/**
 * Annee_scolaire controller.
 *
 * @Route("/annee_scolaire")
 */
class Annee_scolaireController extends Controller
{

    /**
     * Lists all Annee_scolaire entities.
     *
     * @Route("/", name="annee_scolaire")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Annee_scolaire')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Annee_scolaire entity.
     *
     * @Route("/", name="annee_scolaire_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Annee_scolaire:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Annee_scolaire();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('annee_scolaire_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Annee_scolaire entity.
     *
     * @param Annee_scolaire $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Annee_scolaire $entity)
    {
        $form = $this->createForm(new Annee_scolaireType(), $entity, array(
            'action' => $this->generateUrl('annee_scolaire_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Creer'));

        return $form;
    }

    /**
     * Displays a form to create a new Annee_scolaire entity.
     *
     * @Route("/new", name="annee_scolaire_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Annee_scolaire();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Annee_scolaire entity.
     *
     * @Route("/{id}", name="annee_scolaire_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Annee_scolaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee_scolaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Annee_scolaire entity.
     *
     * @Route("/{id}/edit", name="annee_scolaire_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Annee_scolaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee_scolaire entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Annee_scolaire entity.
    *
    * @param Annee_scolaire $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Annee_scolaire $entity)
    {
        $form = $this->createForm(new Annee_scolaireType(), $entity, array(
            'action' => $this->generateUrl('annee_scolaire_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Annee_scolaire entity.
     *
     * @Route("/{id}", name="annee_scolaire_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Annee_scolaire:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Annee_scolaire')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Annee_scolaire entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('annee_scolaire_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Annee_scolaire entity.
     *
     * @Route("/{id}", name="annee_scolaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Annee_scolaire')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Annee_scolaire entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('annee_scolaire'));
    }

    /**
     * Creates a form to delete a Annee_scolaire entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('annee_scolaire_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
