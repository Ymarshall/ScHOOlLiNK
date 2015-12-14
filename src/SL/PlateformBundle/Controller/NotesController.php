<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Notes;
use SL\PlateformBundle\Form\NotesType;
use SL\PlateformBundle\Form\NotesTypeEdit;

/**
 * Notes controller.
 *
 * @Route("/notes")
 */
class NotesController extends Controller
{

    /**
     * Lists all Notes entities.
     *
     * @Route("/", name="notes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Notes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Notes entity.
     *
     * @Route("/", name="notes_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Notes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        // Récupération de la session
            $session = $request->getSession();
            $repositoryMatiere = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Matiere');
        $entity = new Notes();
        $entity->setMatiere($repositoryMatiere->find($session->get('matiere_courante')));
        $form = $this->createCreateForm($entity,$request);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Ajout réussi.');
            return $this->redirect($this->get('router')->generate('sl_professeur_devoirs_interro',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }
        return $this->render('SLDashbordBundle:Professeur:ajouterNotes.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Notes entity.
     *
     * @param Notes $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Notes $entity, Request $request)
    {
        $session=$request->getSession();
        $form = $this->createForm(new NotesType(), $entity, array(
            'action' => $this->generateUrl('notes_create'),
            'method' => 'POST','post_max_size_message'=> $session->get('classe_courante'),
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Notes entity.
     *
     * @Route("/new", name="notes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Notes();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Notes entity.
     *
     * @Route("/{id}", name="notes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Notes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Notes entity.
     *
     * @Route("/{id}/edit", name="notes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Notes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notes entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

                       return $this->render('SLDashbordBundle:Professeur:modifierNotes.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));

    }

    /**
    * Creates a form to edit a Notes entity.
    *
    * @param Notes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Notes $entity)
    {
        $form = $this->createForm(new NotesTypeEdit(), $entity, array(
            'action' => $this->generateUrl('notes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Notes entity.
     *
     * @Route("/{id}", name="notes_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Notes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $session=$request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Notes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Notes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

          $session->getFlashBag()->add('notice', 'modification réussie.');
            return $this->redirect($this->generateUrl('sl_professeur_devoirs_interro',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Notes entity.
     *
     * @Route("/{id}", name="notes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Notes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Notes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('notes'));
    }

    /**
     * Creates a form to delete a Notes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('notes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
