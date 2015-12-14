<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Educateur;
use SL\PlateformBundle\Form\EducateurType;
use SL\PlateformBundle\Entity\EcolePersonne;
use SL\PlateformBundle\Form\EducateurEditType;
/**
 * Educateur controller.
 *
 * @Route("/educateur")
 */
class EducateurController extends Controller
{

    /**
     * Lists all Educateur entities.
     *
     * @Route("/", name="educateur")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Educateur')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Educateur entity.
     *
     * @Route("/", name="educateur_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Educateur:new.html.twig")
     */
    public function createAction(Request $request)
    {
        //recuperation de la session
        $session=$request->getSession();
        $entity = new Educateur();
        $ecoleperso =new EcolePersonne();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //ecole personne
            $ecoleperso->setEcole($em->getRepository('SLPlateformBundle:Ecole')->find($session->get('ecole_courante')));
            $user=$entity->getPersonne();
            $user->setEnabled(true);
            $ecoleperso->setPersonne($user);
            $ecoleperso->setStatut($em->getRepository('SLPlateformBundle:Statut')->findOneBy(array('libelle'=>'Educateur')));
            
            $em->persist($entity);
            $em->persist($ecoleperso);
            $em->flush();

         $request->getSession()->getFlashBag()->add('notice', 'Educateur ajoutée avec succès.');
            return $this->redirect($this->get('router')->generate('sl_admin_educateur_list'));
        }
        return $this->render('SLDashbordBundle:Administrateur:ajoutEducateur.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Educateur entity.
     *
     * @param Educateur $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Educateur $entity)
    {
        $form = $this->createForm(new EducateurType(), $entity, array(
            'action' => $this->generateUrl('educateur_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Créer'));

        return $form;
    }

    /**
     * Displays a form to create a new Educateur entity.
     *
     * @Route("/new", name="educateur_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Educateur();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Educateur entity.
     *
     * @Route("/{id}", name="educateur_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Educateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Educateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Educateur entity.
     *
     * @Route("/{id}/edit", name="educateur_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Educateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Educateur entity.');
        }

        $editForm = $this->createEditForm($entity);
        return $this->render('SLDashbordBundle:Administrateur:modifierEducateur.html.twig',array('entity' => $entity,'form'   => $editForm->createView()));
    }

    /**
    * Creates a form to edit a Educateur entity.
    *
    * @param Educateur $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Educateur $entity)
    {
        $form = $this->createForm(new EducateurEditType(), $entity, array(
            'action' => $this->generateUrl('educateur_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Educateur entity.
     *
     * @Route("/{id}", name="educateur_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Educateur:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Educateur')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Educateur entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Modification des informations réussie.');
            return $this->redirect($this->get('router')->generate('sl_admin_educateur_list'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Educateur entity.
     *
     * @Route("/{id}", name="educateur_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Educateur')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Educateur entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('educateur'));
    }

    /**
     * Creates a form to delete a Educateur entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('educateur_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
