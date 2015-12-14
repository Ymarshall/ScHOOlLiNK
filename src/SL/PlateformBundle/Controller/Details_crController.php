<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Details_cr;
use SL\PlateformBundle\Form\Details_crType;

/**
 * Details_cr controller.
 *
 * @Route("/details_cr")
 */
class Details_crController extends Controller
{

    /**
     * Lists all Details_cr entities.
     *
     * @Route("/", name="details_cr")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Details_cr')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Details_cr entity.
     *
     * @Route("/", name="details_cr_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Details_cr:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        $entity = new Details_cr();
        $entity->setDateMotif(new \DateTime());
        $repositoryEleve=$this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Eleve');
        $entity->setEleve($repositoryEleve->find($session->get('eleve_courant')));
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Mise à jour du Carnet de correspondance éffectuée avec succès.');
            return $this->redirect($this->get('router')->generate('sl_educateur_carnet',array('id'=>$session->get('eleve_courant'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Details_cr entity.
     *
     * @param Details_cr $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Details_cr $entity)
    {
        $form = $this->createForm(new Details_crType(), $entity, array(
            'action' => $this->generateUrl('details_cr_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Details_cr entity.
     *
     * @Route("/new", name="details_cr_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Details_cr();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Details_cr entity.
     *
     * @Route("/{id}", name="details_cr_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_cr entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Details_cr entity.
     *
     * @Route("/{id}/edit", name="details_cr_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_cr entity.');
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
    * Creates a form to edit a Details_cr entity.
    *
    * @param Details_cr $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Details_cr $entity)
    {
        $form = $this->createForm(new Details_crType(), $entity, array(
            'action' => $this->generateUrl('details_cr_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Details_cr entity.
     *
     * @Route("/{id}", name="details_cr_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Details_cr:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_cr')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_cr entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('details_cr_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Details_cr entity.
     *
     * @Route("/{id}", name="details_cr_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
         //recuperation de la session
        $session=$request->getSession();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

       // if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Details_cr')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Details_cr entity.');
            }

            $em->remove($entity);
            $em->flush();
       // }

        $request->getSession()->getFlashBag()->add('notice', 'Suppression réussie.');
            return $this->redirect($this->get('router')->generate('sl_educateur_carnet',array('id'=>$session->get('eleve_courant'))));
    }

    /**
     * Creates a form to delete a Details_cr entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('details_cr_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
