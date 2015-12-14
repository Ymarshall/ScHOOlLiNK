<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\ProfesseurMatiere;
use SL\PlateformBundle\Form\ProfesseurMatiereType;

/**
 * ProfesseurMatiere controller.
 *
 * @Route("/professeurmatiere")
 */
class ProfesseurMatiereController extends Controller
{

    /**
     * Lists all ProfesseurMatiere entities.
     *
     * @Route("/", name="professeurmatiere")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:ProfesseurMatiere')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ProfesseurMatiere entity.
     *
     * @Route("/", name="professeurmatiere_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:ProfesseurMatiere:new.html.twig")
     */
    public function createAction(Request $request)
    {$em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $entity = new ProfesseurMatiere();
        $entity->setProfesseur($em->getRepository('SLPlateformBundle:Professeur')->find($session->get('professeur_courant')));
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->persist($entity);
            $em->flush();

           $request->getSession()->getFlashBag()->add('notice', 'Attribution réussie.');
            return $this->redirect($this->get('router')->generate('sl_admin_professeur_voir',array('id'=>$session->get('professeur_courant'))));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a ProfesseurMatiere entity.
     *
     * @param ProfesseurMatiere $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(ProfesseurMatiere $entity)
    {
        $form = $this->createForm(new ProfesseurMatiereType(), $entity, array(
            'action' => $this->generateUrl('professeurmatiere_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ProfesseurMatiere entity.
     *
     * @Route("/new", name="professeurmatiere_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ProfesseurMatiere();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ProfesseurMatiere entity.
     *
     * @Route("/{id}", name="professeurmatiere_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:ProfesseurMatiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProfesseurMatiere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ProfesseurMatiere entity.
     *
     * @Route("/{id}/edit", name="professeurmatiere_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:ProfesseurMatiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProfesseurMatiere entity.');
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
    * Creates a form to edit a ProfesseurMatiere entity.
    *
    * @param ProfesseurMatiere $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ProfesseurMatiere $entity)
    {
        $form = $this->createForm(new ProfesseurMatiereType(), $entity, array(
            'action' => $this->generateUrl('professeurmatiere_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ProfesseurMatiere entity.
     *
     * @Route("/{id}", name="professeurmatiere_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:ProfesseurMatiere:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:ProfesseurMatiere')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ProfesseurMatiere entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('professeurmatiere_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ProfesseurMatiere entity.
     *
     * @Route("/{id}", name="professeurmatiere_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:ProfesseurMatiere')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ProfesseurMatiere entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('professeurmatiere'));
    }

    /**
     * Creates a form to delete a ProfesseurMatiere entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('professeurmatiere_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
