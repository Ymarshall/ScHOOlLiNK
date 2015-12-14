<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of EleveCours
 *
 * @author Meledje
 */
/**
 * EleveCours
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EleveCoursRepository")
 */
class EleveCours {
   
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Cours", inversedBy="elevescours")
   * @ORM\JoinColumn(name="cours_id", referencedColumnName="id", nullable=false)
   */
  private $cours;

  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Eleve", inversedBy="elevescours")
   * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id", nullable=false)
   */
  private $eleve;

  function getId() {
      return $this->id;
  }

  function getCours() {
      return $this->cours;
  }

  function getEleve() {
      return $this->eleve;
  }

  
  function setCours(Cours $cours) {
      $this->cours = $cours;
  }

  function setEleve(Eleve $eleve) {
      $this->eleve = $eleve;
  }



}
