<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Ecole
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EcoleRepository")
 */
class Ecole
{
    
     /**
     * @ORM\OneToOne(targetEntity="SL\PlateformBundle\Entity\Adresse")
     * @ORM\JoinColumn(name="adresse_id", referencedColumnName="id")
     **/
    private $adresse;
    function getAdresse() {
        return $this->adresse;
    }

    function setAdresse(Adresse $adresse) {
        $this->adresse = $adresse;
    }
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Classe", mappedBy="ecole")
     */
     private $classes;
     
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Examen", mappedBy="ecole")
     */
     private $examens;

             
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EcoleProfesseur", mappedBy="ecole")
     **/
    private $ecoleprofesseurs;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EcolePersonne", mappedBy="ecole")
     **/
    private $ecolespersonnes;
    
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
     * @ORM\Column(name="Nom", type="string", length=128)
     */
    private $nom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_creation", type="date")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="Localisation", type="text",nullable=true)
     */
    private $localisation;

    /**
     * @var string
     *
     * @ORM\Column(name="Latitude", type="string", length=16,nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="Longitude", type="string", length=16,nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="Descriptif", type="text",nullable=true)
     */
    private $descriptif;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string",unique=true, length=12)
     * @Assert\Length(min=8)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Fax", type="string",unique=true, length=12)
     * @Assert\Length(min=8)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=128, unique=true)
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Site_web", type="string", length=255, unique=true)
     * @Assert\Url()
     */
    private $siteWeb;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Ecole
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Ecole
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set localisation
     *
     * @param string $localisation
     *
     * @return Ecole
     */
    public function setLocalisation($localisation)
    {
        $this->localisation = $localisation;

        return $this;
    }

    /**
     * Get localisation
     *
     * @return string
     */
    public function getLocalisation()
    {
        return $this->localisation;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     *
     * @return Ecole
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     *
     * @return Ecole
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set descriptif
     *
     * @param string $descriptif
     *
     * @return Ecole
     */
    public function setDescriptif($descriptif)
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    /**
     * Get descriptif
     *
     * @return string
     */
    public function getDescriptif()
    {
        return $this->descriptif;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Ecole
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return Ecole
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Ecole
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set siteWeb
     *
     * @param string $siteWeb
     *
     * @return Ecole
     */
    public function setSiteWeb($siteWeb)
    {
        $this->siteWeb = $siteWeb;

        return $this;
    }

    /**
     * Get siteWeb
     *
     * @return string
     */
    public function getSiteWeb()
    {
        return $this->siteWeb;
    }
    
      public function __construct()
  {
    $this->ecolespersonnes = new ArrayCollection();
    $this->ecoleprofesseurs = new ArrayCollection();
    $this->classes=new ArrayCollection();
    $this->examens = new ArrayCollection();
  }

  public function addEcolePersonne(EcolePersonne $ecolepersonne)
  {
    $this->ecolespersonnes[] = $ecolepersonne;

    return $this;
  }

  public function removeEcolePersonne(EcolePersonne $ecolepersonne)
  {
    $this->ecolespersonnes->removeElement($ecolepersonne);
  }

  public function getEcolePersonnes()
  {
    return $this->ecolespersonnes;
  }

  public function addEcoleProfesseur(EcoleProfesseur $ecoleprofesseur)
  {
    $this->ecoleprofesseurs[] = $ecoleprofesseur;

    return $this;
  }

  public function removeEcoleProfesseur(EcoleProfesseur $ecoleprofesseur)
  {
    $this->ecoleprofesseurs->removeElement($ecoleprofesseur);
  }

  public function getEcoleProfesseurs()
  {
    return $this->ecoleprofesseurs;
  }

    /**
     * Add ecolespersonne
     *
     * @param \SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne
     *
     * @return Ecole
     */
    public function addEcolespersonne(\SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne)
    {
        $this->ecolespersonnes[] = $ecolespersonne;

        return $this;
    }

    /**
     * Remove ecolespersonne
     *
     * @param \SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne
     */
    public function removeEcolespersonne(\SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne)
    {
        $this->ecolespersonnes->removeElement($ecolespersonne);
    }

    /**
     * Get ecolespersonnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEcolespersonnes()
    {
        return $this->ecolespersonnes;
    }

    /**
     * Add class
     *
     * @param \SL\PlateformBundle\Entity\Classe $class
     *
     * @return Ecole
     */
    public function addClass(\SL\PlateformBundle\Entity\Classe $class)
    {
        $this->classes[] = $class;

        return $this;
    }

    /**
     * Remove class
     *
     * @param \SL\PlateformBundle\Entity\Classe $class
     */
    public function removeClass(\SL\PlateformBundle\Entity\Classe $class)
    {
        $this->classes->removeElement($class);
    }

    /**
     * Get classes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * Add examen
     *
     * @param \SL\PlateformBundle\Entity\Examen $examen
     *
     * @return Ecole
     */
    public function addExamen(\SL\PlateformBundle\Entity\Examen $examen)
    {
        $this->examens[] = $examen;

        return $this;
    }

    /**
     * Remove examen
     *
     * @param \SL\PlateformBundle\Entity\Examen $examen
     */
    public function removeExamen(\SL\PlateformBundle\Entity\Examen $examen)
    {
        $this->examens->removeElement($examen);
    }

    /**
     * Get examens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamens()
    {
        return $this->examens;
    }
}
