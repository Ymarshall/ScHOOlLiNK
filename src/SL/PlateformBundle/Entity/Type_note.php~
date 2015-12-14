<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type_note
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Type_noteRepository")
 */
class Type_note
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Notes", mappedBy="type_note")
     */
     private $notes;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string",unique=true, length=64)
     */
    private $libelle;


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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Type_note
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    
        public function __construct()
  {
    $this->notes = new ArrayCollection();
    // ...
  }

  public function addNote(Notes $note)
  {
    
    $this->notes[] = $note;

    return $this;
  }

  public function removeNote(Notes $note)
  {
    $this->notes->removeElement($note);
  }

  public function getNotes()
  {
    return $this->notes;
  }
}
