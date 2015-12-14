<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Fichier;
use SL\PlateformBundle\Form\FichierType;

/**
 * Fichier controller.
 *
 * @Route("/fichier")
 */
class FichierController extends Controller
{

    /**
     * Lists all Fichier entities.
     *
     * @Route("/", name="fichier")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Fichier')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Fichier entity.
     *
     * @Route("/", name="fichier_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Fichier:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Fichier();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('fichier_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Fichier entity.
     *
     * @param Fichier $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Fichier $entity)
    {
        $form = $this->createForm(new FichierType(), $entity, array(
            'action' => $this->generateUrl('fichier_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Fichier entity.
     *
     * @Route("/new", name="fichier_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Fichier();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Fichier entity.
     *
     * @Route("/{id}", name="fichier_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Fichier entity.
     *
     * @Route("/{id}/edit", name="fichier_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
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
    * Creates a form to edit a Fichier entity.
    *
    * @param Fichier $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Fichier $entity)
    {
        $form = $this->createForm(new FichierType(), $entity, array(
            'action' => $this->generateUrl('fichier_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Fichier entity.
     *
     * @Route("/{id}", name="fichier_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Fichier:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Fichier')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Fichier entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('fichier_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Fichier entity.
     *
     * @Route("/{id}", name="fichier_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Fichier')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Fichier entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('fichier'));
    }

    /**
     * Creates a form to delete a Fichier entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('fichier_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
