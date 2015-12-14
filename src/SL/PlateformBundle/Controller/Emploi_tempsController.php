<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Emploi_temps;
use SL\PlateformBundle\Form\Emploi_tempsType;

/**
 * Emploi_temps controller.
 *
 * @Route("/emploi_temps")
 */
class Emploi_tempsController extends Controller
{

    /**
     * Lists all Emploi_temps entities.
     *
     * @Route("/", name="emploi_temps")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Emploi_temps')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Emploi_temps entity.
     *
     * @Route("/", name="emploi_temps_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Emploi_temps:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $session=$request->getSession();
        $entity = new Emploi_temps();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Emploi du temps créé avec succès.');
            return $this->redirect($this->generateUrl('emploi_temps_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Emploi_temps entity.
     *
     * @param Emploi_temps $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Emploi_temps $entity)
    {
        $form = $this->createForm(new Emploi_tempsType(), $entity, array(
            'action' => $this->generateUrl('emploi_temps_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Emploi_temps entity.
     *
     * @Route("/new", name="emploi_temps_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Emploi_temps();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Emploi_temps entity.
     *
     * @Route("/{id}", name="emploi_temps_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Emploi_temps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emploi_temps entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Emploi_temps entity.
     *
     * @Route("/{id}/edit", name="emploi_temps_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Emploi_temps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emploi_temps entity.');
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
    * Creates a form to edit a Emploi_temps entity.
    *
    * @param Emploi_temps $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Emploi_temps $entity)
    {
        $form = $this->createForm(new Emploi_tempsType(), $entity, array(
            'action' => $this->generateUrl('emploi_temps_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Emploi_temps entity.
     *
     * @Route("/{id}", name="emploi_temps_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Emploi_temps:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Emploi_temps')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Emploi_temps entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('emploi_temps_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Emploi_temps entity.
     *
     * @Route("/{id}", name="emploi_temps_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Emploi_temps')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Emploi_temps entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('emploi_temps'));
    }

    /**
     * Creates a form to delete a Emploi_temps entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emploi_temps_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
