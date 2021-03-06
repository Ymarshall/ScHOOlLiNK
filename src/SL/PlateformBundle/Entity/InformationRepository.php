<?php

namespace SL\PlateformBundle\Entity;

/**
 * InformationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class InformationRepository extends \Doctrine\ORM\EntityRepository
{

    public function getElevesInfos()
    {
      $query = $this->_em->createQuery('SELECT inf FROM SLPlateformBundle:Information inf JOIN inf.categorie c where c.libelle in (:p1,:p2,:p3) ORDER BY inf.dateInformation DESC');
      $query->setParameter('p1', "Eleves");
      $query->setParameter('p2', "Eleves et parent");
      $query->setParameter('p3', "Tout le monde");
      $query->setFirstResult(0);
      $query->setMaxResults(5);
      $results = $query->getResult();
      return $results;
    }
    

    public function getParentsInfos()
    {
      $query = $this->_em->createQuery('SELECT inf FROM SLPlateformBundle:Information inf JOIN inf.categorie c where c.libelle in (:p1,:p2,:p3) ORDER BY inf.dateInformation DESC');
      $query->setParameter('p1', "Parents");
      $query->setParameter('p2', "Eleves et parent");
      $query->setParameter('p3', "Tout le monde");
      $query->setFirstResult(0);
      $query->setMaxResults(5);
      $results = $query->getResult();
      return $results;
    }
    
    public function getProfesseursInfos()
    {
      $query = $this->_em->createQuery('SELECT inf FROM SLPlateformBundle:Information inf JOIN inf.categorie c where c.libelle in (:p1,:p2,:p3) ORDER BY inf.dateInformation DESC');
      $query->setParameter('p1', "Professeurs");
      $query->setParameter('p2', "Personnel");
      $query->setParameter('p3', "Tout le monde");
      $query->setFirstResult(0);
      $query->setMaxResults(5);
      $results = $query->getResult();
      return $results;
    }
    
     public function getEducateursInfos()
    {
      $query = $this->_em->createQuery('SELECT inf FROM SLPlateformBundle:Information inf JOIN inf.categorie c where c.libelle in (:p1,:p2,:p3) ORDER BY inf.dateInformation DESC');
      $query->setParameter('p1', "Educateurs");
      $query->setParameter('p2', "Personnel");
      $query->setParameter('p3', "Tout le monde");
      $query->setFirstResult(0);
      $query->setMaxResults(5);
      $results = $query->getResult();
      return $results;
    }
}
