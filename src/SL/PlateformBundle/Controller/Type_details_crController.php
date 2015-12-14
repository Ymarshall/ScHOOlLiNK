<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Type_details_cr;
use SL\PlateformBundle\Form\Type_details_crType;

/**
 * Type_details_cr controller.
 *
 * @Route("/type_details_cr")
 */
class Type_details_crController extends Controller
{

    /**
     * Lists all Type_details_cr entities.
     *
     * @Route("/", name="type_details_cr")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Type_details_cr')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Type_details_cr entity.
     *
     * @Route("/", name="type_details_cr_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Type_details_cr:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Type_details_cr();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('type_details_cr_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Type_details_cr entity.
     *
     * @param Type_details_cr $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Type_details_cr $entity)
    {
        $form = $this->createForm(new Type_details_crType(), $entity, array(
            'action' => $this->generateUrl('type_details_cr_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Type_details_cr entity.
     *
     * @Route("/new", name="type_details_cr_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Type_details_cr();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Type_details_cr entity.
     *
     * @Route("/{id}", name="type_details_cr_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_details_cr entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Type_details_cr entity.
     *
     * @Route("/{id}/edit", name="type_details_cr_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_details_cr entity.');
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
    * Creates a form to edit a Type_details_cr entity.
    *
    * @param Type_details_cr $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Type_details_cr $entity)
    {
        $form = $this->createForm(new Type_details_crType(), $entity, array(
            'action' => $this->generateUrl('type_details_cr_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Type_details_cr entity.
     *
     * @Route("/{id}", name="type_details_cr_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Type_details_cr:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Type_details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Type_details_cr entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('type_details_cr_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Type_details_cr entity.
     *
     * @Route("/{id}", name="type_details_cr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Type_details_cr')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Type_details_cr entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('type_details_cr'));
    }

    /**
     * Creates a form to delete a Type_details_cr entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('type_details_cr_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
