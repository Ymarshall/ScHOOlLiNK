<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Parents;
use SL\PlateformBundle\Form\ParentsType;

/**
 * Parents controller.
 *
 * @Route("/parents")
 */
class ParentsController extends Controller
{

    /**
     * Lists all Parents entities.
     *
     * @Route("/", name="parents")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Parents')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Parents entity.
     *
     * @Route("/", name="parents_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Parents:new.html.twig")
     */
    public function createAction(Request $request)
    {
         $em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $entity = new Parents();
        $eleve=$em->getRepository('SLPlateformBundle:Eleve')->find($session->get('eleve_courant'));
        
        $ecoleperso =new \SL\PlateformBundle\Entity\EcolePersonne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
           
             //ecole personne
            $ecoleperso->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
            $user=$entity->getPersonne();
            $user->setEnabled(true);
            $ecoleperso->setPersonne($user);
            $ecoleperso->setStatut($em->getRepository('SLPlateformBundle:Statut')->findOneBy(array('libelle'=>'Parent')));
            
            //eleve
            $eleve->setParent($entity);
            $em->persist($entity);
            $em->persist($ecoleperso);
             $em->persist($eleve);
            $em->flush();
            $session->getFlashBag()->add('notice', 'Parent ajouté avec succès.');
            return $this->redirect($this->generateUrl('sl_educateur_carnet', array('id' => $session->get('eleve_courant'))));
        }

        return $this->render('SLDashbordBundle:Educateur:ajouterParent.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Parents entity.
     *
     * @param Parents $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Parents $entity)
    {
        $form = $this->createForm(new ParentsType(), $entity, array(
            'action' => $this->generateUrl('parents_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Parents entity.
     *
     * @Route("/new", name="parents_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Parents();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Parents entity.
     *
     * @Route("/{id}", name="parents_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Parents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parents entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Parents entity.
     *
     * @Route("/{id}/edit", name="parents_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Parents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parents entity.');
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
    * Creates a form to edit a Parents entity.
    *
    * @param Parents $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Parents $entity)
    {
        $form = $this->createForm(new ParentsType(), $entity, array(
            'action' => $this->generateUrl('parents_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Parents entity.
     *
     * @Route("/{id}", name="parents_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Parents:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Parents')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Parents entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('parents_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Parents entity.
     *
     * @Route("/{id}", name="parents_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Parents')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Parents entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('parents'));
    }

    /**
     * Creates a form to delete a Parents entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parents_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
