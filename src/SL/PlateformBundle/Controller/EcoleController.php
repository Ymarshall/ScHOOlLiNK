<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Ecole;
use SL\PlateformBundle\Form\EcoleType;

/**
 * Ecole controller.
 *
 * @Route("/ecole")
 */
class EcoleController extends Controller
{

    /**
     * Lists all Ecole entities.
     *
     * @Route("/", name="ecole")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Ecole')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Ecole entity.
     *
     * @Route("/", name="ecole_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Ecole:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Ecole();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ecole_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Ecole entity.
     *
     * @param Ecole $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Ecole $entity)
    {
        $form = $this->createForm(new EcoleType(), $entity, array(
            'action' => $this->generateUrl('ecole_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Ecole entity.
     *
     * @Route("/new", name="ecole_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Ecole();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Ecole entity.
     *
     * @Route("/{id}", name="ecole_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Ecole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ecole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ecole entity.
     *
     * @Route("/{id}/edit", name="ecole_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Ecole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ecole entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

                return $this->render('SLDashbordBundle:dashbord:modifierEcole.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));

    }

    /**
    * Creates a form to edit a Ecole entity.
    *
    * @param Ecole $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ecole $entity)
    {
        $form = $this->createForm(new EcoleType(), $entity, array(
            'action' => $this->generateUrl('ecole_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Ecole entity.
     *
     * @Route("/{id}", name="ecole_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Ecole:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $session=$request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Ecole')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ecole entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $session->getFlashBag()->add('notice', 'Modification des informations réussie.');
            return $this->redirect($this->get('router')->generate('sl_dashbord_ecole'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Ecole entity.
     *
     * @Route("/{id}", name="ecole_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Ecole')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ecole entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ecole'));
    }

    /**
     * Creates a form to delete a Ecole entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ecole_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
