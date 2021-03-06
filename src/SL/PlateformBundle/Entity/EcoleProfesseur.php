<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\PlateformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Description of EcoleProfesseur
 *
 * @author Meledje
 */
/**
 * EcoleProfesseur
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="ecole_prof", columns={"ecole_id", "professeur_id"})})
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EcoleProfesseurRepository")
 */
class EcoleProfesseur {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Ecole", inversedBy="ecoleprofesseurs")
   * @ORM\JoinColumn(name="ecole_id", referencedColumnName="id", nullable=false)
   */
  private $ecole;
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Professeur", inversedBy="ecoleprofesseurs", cascade={"persist"})
   * @ORM\JoinColumn(name="professeur_id", referencedColumnName="id", nullable=false)
   */
  private $professeur;
  
    /**
     * @var string
     *
     * @ORM\Column(name="Statut", type="string", length=128)
     */
    private $statut;
    
      
    function getId() {
        return $this->id;
    }

    function getEcole() {
        return $this->ecole;
    }

    function getProfesseur() {
        return $this->professeur;
    }

    function getStatut() {
        return $this->statut;
    }

    function setEcole(Ecole $ecole) {
        $this->ecole = $ecole;
    }

    function setProfesseur(Professeur $professeur) {
        $this->professeur = $professeur;
    }

    function setStatut($statut) {
        $this->statut = $statut;
    }


}
