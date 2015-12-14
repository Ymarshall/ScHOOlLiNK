<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Notes
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\NotesRepository")
 */
class Notes
{
    
    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Type_note", inversedBy="notes")
   * @ORM\JoinColumn(name="type_note_id", referencedColumnName="id", nullable=false)
   */
  private $type_note;
  function getTypenote() {
      return $this->type_note;
  }

  function setTypenote(Type_note $type_note) {
      $this->type_note = $type_note;
  }

   /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Eleve", inversedBy="notes")
   * @ORM\JoinColumn(name="eleve_id", referencedColumnName="id", nullable=false)
   */
  private $eleve;
  function getEleve() {
      return $this->eleve;
  }

  function setEleve(Eleve $eleve) {
      $this->eleve = $eleve;
  }
  
  /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Matiere", inversedBy="notes")
   * @ORM\JoinColumn(name="matiere_id", referencedColumnName="id", nullable=false)
   */
  private $matiere;
  function getMatiere() {
      return $this->matiere;
  }

  function setMatiere($matiere) {
      $this->matiere = $matiere;
  }

  
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
     * @ORM\Column(name="Note", type="float")
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="Coefficient", type="smallint")
     */
    private $coefficient;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_compo", type="date")
     */
    private $dateCompo;

        /**
     * @var string
     *
     * @ORM\Column(name="Appreciation", type="string", length=128)
     */
    private $appreciation;
    function getAppreciation() {
        return $this->appreciation;
    }

    function setAppreciation($appreciation) {
        $this->appreciation = $appreciation;
    }

        /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set note
     *
     * @param float $note
     *
     * @return Notes
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return float
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set coefficient
     *
     * @param integer $coefficient
     *
     * @return Notes
     */
    public function setCoefficient($coefficient)
    {
        $this->coefficient = $coefficient;

        return $this;
    }

    /**
     * Get coefficient
     *
     * @return integer
     */
    public function getCoefficient()
    {
        return $this->coefficient;
    }

    /**
     * Set dateCompo
     *
     * @param \DateTime $dateCompo
     *
     * @return Notes
     */
    public function setDateCompo($dateCompo)
    {
        $this->dateCompo = $dateCompo;

        return $this;
    }

    /**
     * Get dateCompo
     *
     * @return \DateTime
     */
    public function getDateCompo()
    {
        return $this->dateCompo;
    }
    

    
}
