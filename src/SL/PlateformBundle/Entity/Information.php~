<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Information
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\InformationRepository")
 */
class Information
{
    
     /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Categorie")
   * @ORM\JoinColumn(nullable=false)
   */
  private $categorie;
  
  function getCategorie() {
      return $this->categorie;
  }

  function setCategorie(Categorie $categorie) {
      $this->categorie = $categorie;
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
     * @ORM\Column(name="Titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateInformation", type="date")
     */
    private $dateInformation;


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
     * Set titre
     *
     * @param string $titre
     *
     * @return Information
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Information
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set dateInformation
     *
     * @param \DateTime $dateInformation
     *
     * @return Information
     */
    public function setDateInformation($dateInformation)
    {
        $this->dateInformation = $dateInformation;

        return $this;
    }

    /**
     * Get dateInformation
     *
     * @return \DateTime
     */
    public function getDateInformation()
    {
        return $this->dateInformation;
    }
    
      public function __construct()
  {
    $this->dateInformation = new \Datetime();
  }
}
