<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Composant;
use SL\PlateformBundle\Form\ComposantType;

/**
 * Composant controller.
 *
 * @Route("/composant")
 */
class ComposantController extends Controller
{

    /**
     * Lists all Composant entities.
     *
     * @Route("/", name="composant")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Composant')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Composant entity.
     *
     * @Route("/", name="composant_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Composant:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        //recuperation de la session
        $session=$request->getSession();
       
        
        $entity = new Composant();
        $entity->setJour($em->getRepository('SLPlateformBundle:Jour')->find($session->get('jour')));
        $entity->setEmploitemps($em->getRepository('SLPlateformBundle:Classe')->find($session->get('classe'))->getEmploiTemps());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Composant créé avec succès.');
            return $this->redirect($this->get('router')->generate('sl_dashbord_emploi',array('id'=>$session->get('classe'))));
        }

             return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );

    }

    /**
     * Creates a form to create a Composant entity.
     *
     * @param Composant $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Composant $entity)
    {
        $form = $this->createForm(new ComposantType(), $entity, array(
            'action' => $this->generateUrl('composant_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Composant entity.
     *
     * @Route("/new", name="composant_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Composant();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Composant entity.
     *
     * @Route("/{id}", name="composant_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Composant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Composant entity.
     *
     * @Route("/{id}/edit", name="composant_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Composant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composant entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

               return $this->render('SLDashbordBundle:Educateur:ajouterComposant.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));

    }

    /**
    * Creates a form to edit a Composant entity.
    *
    * @param Composant $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Composant $entity)
    {
        $form = $this->createForm(new ComposantType(), $entity, array(
            'action' => $this->generateUrl('composant_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Composant entity.
     *
     * @Route("/{id}", name="composant_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Composant:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $session=$request->getSession();
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Composant')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Composant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

           $session->getFlashBag()->add('notice', 'Modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_dashbord_emploi',array('id'=>$session->get('classe'))));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Composant entity.
     *
     * @Route("/{id}", name="composant_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
         // Récupération de la session
            $session = $request->getSession();
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

     //   if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Composant')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Composant entity.');
            }

            $em->remove($entity);
            $em->flush();
      //  }

         $session->getFlashBag()->add('notice', 'Suppression réussie.');
            return $this->redirect($this->get('router')->generate('sl_dashbord_emploi',array('id'=>$session->get('classe'))));
    }

    /**
     * Creates a form to delete a Composant entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('composant_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
