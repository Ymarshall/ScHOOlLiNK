<?php

namespace SL\PlateformBundle\Entity;

/**
 * PersonneRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
        //requete pour lister les types de notes d'un eleve en fonction de son id de user
    public function getDirecteur($id)
    {
      $query = $this->_em->createQuery('SELECT us FROM SLPlateformBundle:User us JOIN us.ecolespersonnes ep JOIN ep.statut st JOIN ep.ecole ec where ec.id=:id and st.libelle=:lib');
      $query->setParameter('id', $id);
      $query->setParameter('lib', "Directeur");
      $results = $query->getSingleResult();
      return $results;
    }
}
