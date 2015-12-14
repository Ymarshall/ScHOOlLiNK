<?php

namespace SL\PlateformBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use SL\PlateformBundle\Entity\Cours_exo;
use SL\PlateformBundle\Form\Cours_exoType;

/**
 * Cours_exo controller.
 *
 * @Route("/cours_exo")
 */
class Cours_exoController extends Controller
{

    /**
     * Lists all Cours_exo entities.
     *
     * @Route("/", name="cours_exo")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('SLPlateformBundle:Cours_exo')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Cours_exo entity.
     *
     * @Route("/", name="cours_exo_create")
     * @Method("POST")
     * @Template("SLPlateformBundle:Cours_exo:new.html.twig")
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
        
        $entity = new Cours_exo();
        $entity->setProfesseurmatiere($profMat);
        $entity->setDateEnregistrement(new \Datetime());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $request->getSession()->getFlashBag()->add('notice', 'Opération éffectuée avec succès.');
           // return $this->redirect($this->generateUrl('cours_exo_show', array('id' => $entity->getId())));
             return $this->redirect($this->get('router')->generate('sl_professeur_cours_exo',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }

       return $this->render('SLDashbordBundle:Professeur:ajoutCoursExo.html.twig',array('entity' => $entity,'form'   => $form->createView()));
    }

    /**
     * Creates a form to create a Cours_exo entity.
     *
     * @param Cours_exo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cours_exo $entity)
    {
        $form = $this->createForm(new Cours_exoType(), $entity, array(
            'action' => $this->generateUrl('cours_exo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Ajouter'));

        return $form;
    }

    /**
     * Displays a form to create a new Cours_exo entity.
     *
     * @Route("/new", name="cours_exo_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Cours_exo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cours_exo entity.
     *
     * @Route("/{id}", name="cours_exo_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Cours_exo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cours_exo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cours_exo entity.
     *
     * @Route("/{id}/edit", name="cours_exo_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('SLPlateformBundle:Cours_exo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cours_exo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        return $this->render('SLDashbordBundle:Professeur:modifierCoursExo.html.twig',array('entity' => $entity,'form'   => $editForm->createView(),'delete_form' => $deleteForm->createView()));
        /*return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );*/
    }

    /**
    * Creates a form to edit a Cours_exo entity.
    *
    * @param Cours_exo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Cours_exo $entity)
    {
        $form = $this->createForm(new Cours_exoType(), $entity, array(
            'action' => $this->generateUrl('cours_exo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Modifier'));

        return $form;
    }
    /**
     * Edits an existing Cours_exo entity.
     *
     * @Route("/{id}", name="cours_exo_update")
     * @Method("PUT")
     * @Template("SLPlateformBundle:Cours_exo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        // Récupération de la session
            $session = $request->getSession();
        $entity = $em->getRepository('SLPlateformBundle:Cours_exo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cours_exo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            $session->getFlashBag()->add('notice', 'Modification réussie.');
            return $this->redirect($this->get('router')->generate('sl_professeur_cours_exo',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Cours_exo entity.
     *
     * @Route("/{id}", name="cours_exo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        // Récupération de la session
            $session = $request->getSession();
        //$form = $this->createDeleteForm($id);
        //$form->handleRequest($request);
        
       // if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('SLPlateformBundle:Cours_exo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cours_exo entity.');
            }

            $em->remove($entity);
            $em->flush();
       // }
            $session->getFlashBag()->add('notice', 'Suppression réussie.');
            return $this->redirect($this->get('router')->generate('sl_professeur_cours_exo',array('classe'=> $session->get('classe_courante') ,'matiere'=> $session->get('matiere_courante'))));
    }

    /**
     * Creates a form to delete a Cours_exo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cours_exo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
