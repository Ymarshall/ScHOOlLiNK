<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Details_cr
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Details_crRepository")
 */
class Details_cr
{
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Type_details_cr", inversedBy="details_crs")
     * @ORM\JoinColumn(nullable=true)
     */
  private $type_details_cr;
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Eleve", inversedBy="details_crs")
     * @ORM\JoinColumn(nullable=true)
     */
  private $eleve;
  function getType_details_cr() {
      return $this->type_details_cr;
  }

  function getEleve() {
      return $this->eleve;
  }

  function setType_details_cr(Type_details_cr $type_details_cr) {
      $this->type_details_cr = $type_details_cr;
  }

  function setEleve(Eleve $eleve) {
      $this->eleve = $eleve;
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
     * @ORM\Column(name="Objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_motif", type="date")
     */
    private $dateMotif;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text",nullable=true)
     */
    private $description;


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
     * Set objet
     *
     * @param string $objet
     *
     * @return Details_cr
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set dateMotif
     *
     * @param \DateTime $dateMotif
     *
     * @return Details_cr
     */
    public function setDateMotif($dateMotif)
    {
        $this->dateMotif = $dateMotif;

        return $this;
    }

    /**
     * Get dateMotif
     *
     * @return \DateTime
     */
    public function getDateMotif()
    {
        return $this->dateMotif;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Details_cr
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
     * Set typeDetailsCr
     *
     * @param \SL\PlateformBundle\Entity\Type_details_cr $typeDetailsCr
     *
     * @return Details_cr
     */
    public function setTypeDetailsCr(\SL\PlateformBundle\Entity\Type_details_cr $typeDetailsCr = null)
    {
        $this->type_details_cr = $typeDetailsCr;

        return $this;
    }

    /**
     * Get typeDetailsCr
     *
     * @return \SL\PlateformBundle\Entity\Type_details_cr
     */
    public function getTypeDetailsCr()
    {
        return $this->type_details_cr;
    }
    
      public function __construct()
  {
    $this->dateMotif = new \DateTime();
  }
}
