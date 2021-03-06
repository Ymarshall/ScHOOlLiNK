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
 * Description of ProfesseurMatiere
 *
 * @author Meledje
 */
/**
 * EleveExamen
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="eleve_examen", columns={"eleve_id","matiere_id", "examen_id"})})
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EleveExamenRepository")
 */
class EleveExamen {
   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
     /**
     * @var float
     *
     * @ORM\Column(name="note", type="float",nullable=false)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="coefficient", type="smallint",nullable=false)
     */
    private $coefficient;
    
    /**
     * @var string
     *
     * @ORM\Column(name="appreciation", type="string", length=255,nullable=false)
     */
    private $appreciation;
    function getNote() {
        return $this->note;
    }

    function getCoefficient() {
        return $this->coefficient;
    }

    function getAppreciation() {
        return $this->appreciation;
    }

    function setNote($note) {
        $this->note = $note;
    }

    function setCoefficient($coefficient) {
        $this->coefficient = $coefficient;
    }

    function setAppreciation($appreciation) {
        $this->appreciation = $appreciation;
    }

    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Eleve", inversedBy="eleveexamens")
   * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id", nullable=false)
   */
  private $eleve;
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Matiere", inversedBy="eleveexamens")
   * @ORM\JoinColumn(name="matiere_id", referencedColumnName="id", nullable=false)
   */
  private $matiere;

      /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Examen", inversedBy="eleveexamens")
   * @ORM\JoinColumn(name="examen_id", referencedColumnName="id", nullable=false)
   */
  private $examen;
  

    function getId() {
      return $this->id;
  }

  

  function getMatiere() {
      return $this->matiere;
  }

 

  function setMatiere(Matiere $matiere) {
      $this->matiere = $matiere;
  }
  function getEleve() {
      return $this->eleve;
  }

  function getExamen() {
      return $this->examen;
  }

  function setEleve(Eleve $eleve) {
      $this->eleve = $eleve;
  }

  function setExamen(Examen $examen) {
      $this->examen = $examen;
  }


  
}
