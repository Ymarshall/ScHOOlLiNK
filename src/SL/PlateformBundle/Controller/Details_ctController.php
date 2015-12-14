<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Details_ct;
use SL\PlateformBundle\Form\Details_ctType;

/**
 * Details_ct controller.
 *
 * @Route("/details_ct")
 */
class Details_ctController extends Controller
{

    /**
     * Lists all Details_ct entities.
     *
     * @Route("/", name="details_ct")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Details_ct')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Details_ct entity.
     *
     * @Route("/", name="details_ct_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Details_ct:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de l'identifiant du user
            $user = $this->container->get('security.context')->getToken()->getUser();
            $ident=$user->getId();
            
            // Récupération de la session
            $session = $request->getSession();
       //obtenir le professeurmatiere
        $repository = $this->getDoctrine()->getManager()->getRepository('SLPlateformBundle:ProfesseurMatiere');
        $profMat=$repository->getProfesseurMatiere($ident,$session->get('matiere_courante'),$session->get('classe_courante'));
        $entity = new Details_ct();
        $entity->setProfesseurmatiere($profMat);
        $entity->setDateEnregistrement(new \Datetime());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            //return $this->redirect($this->generateUrl('details_ct_show', array('id' => $entity->getId())));
            $request->getSession()->getFlashBag()->add('notice', 'Mise à jour du Cahier de texte éffectuée avec succès.');
            return $this->redirect($this->get('router')->generate('sl_professeur_cahier_texte',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }
        return $this->render('SLDashbordBundle:Professeur:ajoutCahier.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Details_ct entity.
     *
     * @param Details_ct $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Details_ct $entity)
    {
        $form = $this->createForm(new Details_ctType(), $entity, array(
            'action' => $this->generateUrl('details_ct_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Details_ct entity.
     *
     * @Route("/new", name="details_ct_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Details_ct();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Details_ct entity.
     *
     * @Route("/{id}", name="details_ct_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_ct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_ct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Details_ct entity.
     *
     * @Route("/{id}/edit", name="details_ct_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_ct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_ct entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        return $this->render('SLDashbordBundle:Professeur:modifierCahier.html.twig',array('entity' => $entity,'form'   => $editForm->createView()));
       /* return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );*/
    }

    /**
    * Creates a form to edit a Details_ct entity.
    *
    * @param Details_ct $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Details_ct $entity)
    {
        $form = $this->createForm(new Details_ctType(), $entity, array(
            'action' => $this->generateUrl('details_ct_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Details_ct entity.
     *
     * @Route("/{id}", name="details_ct_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Details_ct:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        // Récupération de la session
            $session = $request->getSession();
            
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Details_ct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Details_ct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_professeur_cahier_texte',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }
        
        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Details_ct entity.
     *
     * @Route("/{id}", name="details_ct_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Details_ct')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Details_ct entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('details_ct'));
    }

    /**
     * Creates a form to delete a Details_ct entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('details_ct_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
