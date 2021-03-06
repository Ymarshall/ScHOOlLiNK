<?php

namespace SL\PlateformBundle\Entity;

/**
 * Details_crRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class Details_crRepository extends \Doctrine\ORM\EntityRepository
{
    //requete pour obtenir les details du carnet de correspondance en fonction d'un type et de l'eleve
    public function getDetailsCrByTypeAndEleve($idT, $idE)
    {
      $query = $this->_em->createQuery('SELECT cr FROM SLPlateformBundle:Details_cr cr JOIN cr.eleve el JOIN cr.type_details_cr td where td.id=:idT and el.id=:idE');
      $query->setParameter('idT', $idT);
      $query->setParameter('idE', $idE);
      $results = $query->getResult();
      return $results;
    }
    
    //requete pour obtenir les details du carnet de correspondance en fonction d'un type et de l'user
    public function getDetailsCrByTypeAndUser($idT, $idU)
    {
      $query = $this->_em->createQuery('SELECT cr FROM SLPlateformBundle:Details_cr cr JOIN cr.eleve el JOIN el.personne p JOIN cr.type_details_cr td where td.id=:idT and p.id=:idU');
      $query->setParameter('idT', $idT);
      $query->setParameter('idU', $idU);
      $results = $query->getResult();
      return $results;
    }
    
    //requete pour obtenir le nombre d'absence d'un eleve
    public function getNombreAbsence($id)
    {
      $query = $this->_em->createQuery('SELECT COUNT(dt.id) FROM SLPlateformBundle:Details_cr dt JOIN dt.type_details_cr td JOIN dt.eleve el where el.id=:id and td.libelle=:libelle');
      $query->setParameter('id', $id);
      $query->setParameter('libelle', "Absence");
      $results = $query->getSingleScalarResult();
      return $results;
    }
}
