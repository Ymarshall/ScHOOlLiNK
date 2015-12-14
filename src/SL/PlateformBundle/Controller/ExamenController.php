<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Examen;
use SL\PlateformBundle\Form\ExamenType;

/**
 * Examen controller.
 *
 * @Route("/examen")
 */
class ExamenController extends Controller
{

    /**
     * Lists all Examen entities.
     *
     * @Route("/", name="examen")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Examen')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Examen entity.
     *
     * @Route("/", name="examen_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Examen:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $session=$request->getSession();
        $entity = new Examen();
        $entity->setAnneeScolaire($em->getRepository('SLPlateformBundle:Annee_scolaire')->find($session->get('annee_courante')));
        $entity->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $ep = $this->getDoctrine()->getManager();
            $ep->persist($entity);
            $ep->flush();
            $session->getFlashBag()->add('notice', 'Examen blanc crée avec succès.');
            return $this->redirect($this->generateUrl('sl_admin_examen_list'));
        }

       return $this->render('SLDashbordBundle:Professeur:ajoutExamen.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Examen entity.
     *
     * @param Examen $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Examen $entity)
    {
        $form = $this->createForm(new ExamenType(), $entity, array(
            'action' => $this->generateUrl('examen_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Examen entity.
     *
     * @Route("/new", name="examen_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Examen();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Examen entity.
     *
     * @Route("/{id}", name="examen_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Examen entity.
     *
     * @Route("/{id}/edit", name="examen_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

               return $this->render('SLDashbordBundle:Administrateur:modifierExamen.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));

    }

    /**
    * Creates a form to edit a Examen entity.
    *
    * @param Examen $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Examen $entity)
    {
        $form = $this->createForm(new ExamenType(), $entity, array(
            'action' => $this->generateUrl('examen_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Examen entity.
     *
     * @Route("/{id}", name="examen_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Examen:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $session=$request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Examen')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Examen entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $session->getFlashBag()->add('notice', 'modification réussie.');
            return $this->redirect($this->generateUrl('sl_admin_examen_list'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Examen entity.
     *
     * @Route("/{id}", name="examen_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $session=$request->getSession();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Examen')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Examen entity.');
            }

            $em->remove($entity);
            $em->flush();
    
            $session->getFlashBag()->add('notice', 'Suppression réussie.');
        return $this->redirect($this->generateUrl('sl_admin_examen_list'));
    }

    /**
     * Creates a form to delete a Examen entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('examen_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
