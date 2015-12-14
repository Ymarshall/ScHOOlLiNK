<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\PlateformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Description of ProfesseurMatiere
 *
 * @author Meledje
 */
/**
 * ProfesseurMatiere
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ProfesseurMatiereRepository")
 */
class ProfesseurMatiere {
   /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateAttribution", type="date", nullable=true)
     * @Assert\DateTime()
     */
    private $dateAttribution;
    function getDateAttribution() {
        return $this->dateAttribution;
    }

    function setDateAttribution(\DateTime $dateAttribution) {
        $this->dateAttribution = $dateAttribution;
    }

      /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Professeur", inversedBy="professeurmatieres")
   * @ORM\JoinColumn(name="professeur_id", referencedColumnName="id", nullable=false)
   */
  private $professeur;
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Matiere", inversedBy="professeurmatieres")
   * @ORM\JoinColumn(name="matiere_id", referencedColumnName="id", nullable=false)
   */
  private $matiere;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Details_ct", mappedBy="professeurmatiere")
     **/
    private $detailscts;
    
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Cours_exo", mappedBy="professeurmatiere")
     **/
    private $coursexos;
  

      /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Classe", inversedBy="professeurmatieres")
   * @ORM\JoinColumn(name="classe_id", referencedColumnName="id", nullable=false)
   */
  private $classe;
  function getClasse() {
      return $this->classe;
  }

  function setClasse(Classe $classe) {
      $this->classe = $classe;
  }

    function getId() {
      return $this->id;
  }

  function getProfesseur() {
      return $this->professeur;
  }

  function getMatiere() {
      return $this->matiere;
  }

   function setProfesseur(Professeur $professeur) {
      $this->professeur = $professeur;
  }

  function setMatiere(Matiere $matiere) {
      $this->matiere = $matiere;
  }
  
    public function __construct()
  {
    $this->coursexos = new ArrayCollection();
    $this->detailscts = new ArrayCollection();
    $this->dateAttribution = new \DateTime();
  }

  public function addCoursexo(Cours_exo $coursexo)
  {
    $this->coursexos[] = $coursexo;

    return $this;
  }

  public function removeCoursexo(Cours_exo $coursexo)
  {
    $this->coursexos->removeElement($coursexo);
  }

  public function getCoursexos()
  {
    return $this->coursexos;
  }
  
  public function addDetailsct(Details_ct $details)
  {
    $this->detailscts[] = $details;

    return $this;
  }

  public function removeDetailsct(Details_ct $details)
  {
    $this->detailscts->removeElement($details);
  }

  public function getDetailscts()
  {
    return $this->detailscts;
  }
  
  
}
