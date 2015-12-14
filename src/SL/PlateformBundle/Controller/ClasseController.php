<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Classe;
use SL\PlateformBundle\Form\ClasseType;

/**
 * Classe controller.
 *
 * @Route("/classe")
 */
class ClasseController extends Controller
{

    /**
     * Lists all Classe entities.
     *
     * @Route("/", name="classe")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Classe')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Classe entity.
     *
     * @Route("/", name="classe_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Classe:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        //recuperation de l'identifiant du user
         $user = $this->container->get('security.context')->getToken()->getUser();
         //recuperons l'ecole
         $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:Ecole');
        $ecole = $repository->getEcoleByUser($user->getId());
            
        $entity = new Classe();
        $entity->setEcole($ecole);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

           //return $this->redirect($this->generateUrl('details_ct_show', array('id' => $entity->getId())));
            $session->getFlashBag()->add('notice', 'Classe créée avec succès.');
            return $this->redirect($this->get('router')->generate('sl_professeur_list_classe'));
        }
        return $this->render('SLDashbordBundle:Administrateur:ajouterClasse.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Classe entity.
     *
     * @param Classe $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Classe $entity)
    {
        $form = $this->createForm(new ClasseType(), $entity, array(
            'action' => $this->generateUrl('classe_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Classe entity.
     *
     * @Route("/new", name="classe_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Classe();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Classe entity.
     *
     * @Route("/{id}", name="classe_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Classe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Classe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Classe entity.
     *
     * @Route("/{id}/edit", name="classe_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Classe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Classe entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('SLDashbordBundle:Administrateur:modifierClasse.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));
    }

    /**
    * Creates a form to edit a Classe entity.
    *
    * @param Classe $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Classe $entity)
    {
        $form = $this->createForm(new ClasseType(), $entity, array(
            'action' => $this->generateUrl('classe_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Classe entity.
     *
     * @Route("/{id}", name="classe_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Classe:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération de la session
            $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Classe')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Classe entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

           $session->getFlashBag()->add('notice', 'Modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_professeur_list_classe'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Classe entity.
     *
     * @Route("/{id}", name="classe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        // Récupération de la session
            $session = $request->getSession();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        //if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Classe')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Classe entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $session->getFlashBag()->add('notice', 'Suppression réussie.');
            return $this->redirect($this->get('router')->generate('sl_professeur_list_classe'));
   // }
    }
    /**
     * Creates a form to delete a Classe entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('classe_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
