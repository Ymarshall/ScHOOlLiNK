<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cours_exo
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Cours_exoRepository")
 */
class Cours_exo
{
    
    /**
   * @ORM\OneToOne(targetEntity="SL\PlateformBundle\Entity\Fichier", cascade={"persist", "remove"})
     * @Assert\Valid()
   */
  private $fichier;
  function getFichier() {
      return $this->fichier;
  }

  function setFichier(Fichier $fichier) {
      $this->fichier = $fichier;
  }

        /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\ProfesseurMatiere", inversedBy="coursexos")
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
     * @ORM\Column(name="Libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nombre_page", type="smallint")
     */
    private $nombrePage;

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateEnregistrement", type="date")
     */
    private $dateEnregistrement;

    function getDateEnregistrement() {
        return $this->dateEnregistrement;
    }

    function setDateEnregistrement(\DateTime $dateEnregistrement) {
        $this->dateEnregistrement = $dateEnregistrement;
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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Cours_exo
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

    /**
     * Set nombrePage
     *
     * @param integer $nombrePage
     *
     * @return Cours_exo
     */
    public function setNombrePage($nombrePage)
    {
        $this->nombrePage = $nombrePage;

        return $this;
    }

    /**
     * Get nombrePage
     *
     * @return integer
     */
    public function getNombrePage()
    {
        return $this->nombrePage;
    }

        
    public function __construct()
  {
    $this->dateEnregistrement = new \Datetime();
  }
  
}
