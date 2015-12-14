<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Details_ct
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="details_profmat", columns={"profmatiere_id", "Date_enregistrement"})})
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Details_ctRepository")
 */
class Details_ct
{
   /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\ProfesseurMatiere", inversedBy="detailscts")
   * @ORM\JoinColumn(name="profmatiere_id", referencedColumnName="id", nullable=false)
   */
  private $professeurmatiere;
  function getProfesseurmatiere() {
      return $this->professeurmatiere;
  }

  function setProfesseurmatiere(ProfesseurMatiere $professeurmatiere) {
      $this->professeurmatiere = $professeurmatiere;
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
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nombre_heure", type="smallint")
     */
    private $nombreHeure;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_enregistrement", type="date")
     * @Assert\DateTime()
     */
    private $dateEnregistrement;


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
     * Set description
     *
     * @param string $description
     *
     * @return Details_ct
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set nombreHeure
     *
     * @param integer $nombreHeure
     *
     * @return Details_ct
     */
    public function setNombreHeure($nombreHeure)
    {
        $this->nombreHeure = $nombreHeure;

        return $this;
    }

    /**
     * Get nombreHeure
     *
     * @return integer
     */
    public function getNombreHeure()
    {
        return $this->nombreHeure;
    }

    /**
     * Set dateEnregistrement
     *
     * @param \DateTime $dateEnregistrement
     *
     * @return Details_ct
     */
    public function setDateEnregistrement($dateEnregistrement)
    {
        $this->dateEnregistrement = $dateEnregistrement;

        return $this;
    }

    /**
     * Get dateEnregistrement
     *
     * @return \DateTime
     */
    public function getDateEnregistrement()
    {
        return $this->dateEnregistrement;
    }
    
    public function __construct()
  {
    $this->dateEnregistrement = new \Datetime();
  }

    
}
