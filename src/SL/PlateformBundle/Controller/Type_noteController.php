<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Type_note;
use SL\PlateformBundle\Form\Type_noteType;

/**
 * Type_note controller.
 *
 * @Route("/type_note")
 */
class Type_noteController extends Controller
{

    /**
     * Lists all Type_note entities.
     *
     * @Route("/", name="type_note")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Type_note')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Type_note entity.
     *
     * @Route("/", name="type_note_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Type_note:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Type_note();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('type_note_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Type_note entity.
     *
     * @param Type_note $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Type_note $entity)
    {
        $form = $this->createForm(new Type_noteType(), $entity, array(
            'action' => $this->generateUrl('type_note_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Type_note entity.
     *
     * @Route("/new", name="type_note_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Type_note();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Type_note entity.
     *
     * @Route("/{id}", name="type_note_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_note entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Type_note entity.
     *
     * @Route("/{id}/edit", name="type_note_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_note entity.');
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
    * Creates a form to edit a Type_note entity.
    *
    * @param Type_note $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Type_note $entity)
    {
        $form = $this->createForm(new Type_noteType(), $entity, array(
            'action' => $this->generateUrl('type_note_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Type_note entity.
     *
     * @Route("/{id}", name="type_note_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Type_note:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_note')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_note entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('type_note_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Type_note entity.
     *
     * @Route("/{id}", name="type_note_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Type_note')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Type_note entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('type_note'));
    }

    /**
     * Creates a form to delete a Type_note entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_note_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
