<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\EleveExamen;
use SL\PlateformBundle\Form\EleveExamenType;

/**
 * EleveExamen controller.
 *
 * @Route("/eleveexamen")
 */
class EleveExamenController extends Controller
{

    /**
     * Lists all EleveExamen entities.
     *
     * @Route("/", name="eleveexamen")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:EleveExamen')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new EleveExamen entity.
     *
     * @Route("/", name="eleveexamen_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:EleveExamen:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $entity = new EleveExamen();
        $entity->setEleve($em->getRepository('SLPlateformBundle:Eleve')->find($session->get('eleve_courant')));
        $form = $this->createCreateForm($entity,$request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($entity);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Ajout réussie.');
            return $this->redirect($this->generateUrl('sl_dashbord_examen_list', array('id' => $session->get('examen'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a EleveExamen entity.
     *
     * @param EleveExamen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EleveExamen $entity, Request $request)
    {
        $session=$request->getSession();
        $form = $this->createForm(new EleveExamenType(), $entity, array(
            'action' => $this->generateUrl('eleveexamen_create'),
            'method' => 'POST','post_max_size_message'=> $session->get('examen'),
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new EleveExamen entity.
     *
     * @Route("/new", name="eleveexamen_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new EleveExamen();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a EleveExamen entity.
     *
     * @Route("/{id}", name="eleveexamen_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:EleveExamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EleveExamen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing EleveExamen entity.
     *
     * @Route("/{id}/edit", name="eleveexamen_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:EleveExamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EleveExamen entity.');
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
    * Creates a form to edit a EleveExamen entity.
    *
    * @param EleveExamen $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EleveExamen $entity)
    {
        $form = $this->createForm(new EleveExamenType(), $entity, array(
            'action' => $this->generateUrl('eleveexamen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EleveExamen entity.
     *
     * @Route("/{id}", name="eleveexamen_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:EleveExamen:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:EleveExamen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EleveExamen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eleveexamen_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a EleveExamen entity.
     *
     * @Route("/{id}", name="eleveexamen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:EleveExamen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EleveExamen entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eleveexamen'));
    }

    /**
     * Creates a form to delete a EleveExamen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eleveexamen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
