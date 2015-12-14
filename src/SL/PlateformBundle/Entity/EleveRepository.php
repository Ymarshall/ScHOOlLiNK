<?php

namespace SL\PlateformBundle\Entity;

/**
 * EleveRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EleveRepository extends \Doctrine\ORM\EntityRepository
{
        //requete pour obtenir la liste des eleves d'une classe donnée
    public function getElevesByClasse($id)
    {
      $query = $this->_em->createQuery('SELECT el FROM SLPlateformBundle:Eleve el JOIN el.classe cl where cl.id=:id ORDER BY el.personne ASC');
      $query->setParameter('id', $id);
      $results = $query->getResult();
      return $results;
    }
    
    //requete pour obtenir le nombre d'eleves dans une ecole
    public function getNombreEleveByEcole($id)
    {
      $query = $this->_em->createQuery('SELECT count(distinct(el.id)) FROM SLPlateformBundle:Eleve el JOIN el.personne p JOIN p.ecolespersonnes ep JOIN ep.ecole ec where ec.id=:id');
      $query->setParameter('id', $id);
      $results = $query->getSingleScalarResult();
      return $results;
    }
    
    //requete pour lister les types de notes d'un eleve en fonction de son id de user
    public function getChild($id)
    {
      $query = $this->_em->createQuery('SELECT el FROM SLPlateformBundle:Eleve el JOIN el.parent pr JOIN pr.personne p where p.id=:id');
      $query->setParameter('id', $id);
      $results = $query->getSingleResult();
      return $results;
    }
    
     //requete pour lister les eleves concernées par un examen
    public function getElevesByExamen($id)
    {
      $query = $this->_em->createQuery('SELECT el FROM SLPlateformBundle:Eleve el JOIN el.classe cl JOIN cl.examens ex where ex.id=:id');
      $query->setParameter('id', $id);
      $results = $query->getResult();
      return $results;
    }
    
     //requete pour obtenir le nombre de personnes concernées par ce examen 
    public function getNombrePersonnes($id)
    {
      $query = $this->_em->createQuery('SELECT count(el.id) FROM SLPlateformBundle:Eleve el JOIN el.classe cl JOIN cl.examens ex where ex.id=:id');
      $query->setParameter('id', $id);
      $results = $query->getSingleScalarResult();
      return $results;
    }
}