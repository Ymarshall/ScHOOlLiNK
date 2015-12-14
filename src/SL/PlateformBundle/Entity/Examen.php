<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Examen
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="examen_annee", columns={"libelle", "ecole_id", "annee_scolaire_id"})})
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ExamenRepository")
 */
class Examen
{
     /**
   * @ORM\OneToOne(targetEntity="SL\PlateformBundle\Entity\Fichier", cascade={"persist", "remove"})
     * @Assert\Valid()
   */
  private $programme;
  function getProgramme() {
      return $this->programme;
  }

  function setProgramme(Fichier $programme) {
      $this->programme = $programme;
  }

    
    /**
   * @ORM\ManyToMany(targetEntity="SL\PlateformBundle\Entity\Classe",inversedBy="examens")
   */
  private $classes;
  
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Annee_scolaire", inversedBy="examens")
     * @ORM\JoinColumn(nullable=false)
     */
  private $annee_scolaire;
  
  /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Ecole", inversedBy="examens")
     * @ORM\JoinColumn(nullable=false)
     */
  private $ecole;
  function getEcole() {
      return $this->ecole;
  }

  function setEcole(Ecole $ecole) {
      $this->ecole = $ecole;
  }

      /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EleveExamen", mappedBy="examen")
     **/
    private $eleveexamens;
    
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
     * @ORM\Column(name="libelle", type="string", length=128)
     */
    private $libelle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="nombrePoint", type="smallint")
     */
    private $nombrePoint;


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
     * @return Examen
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Examen
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Examen
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set nombrePoint
     *
     * @param integer $nombrePoint
     *
     * @return Examen
     */
    public function setNombrePoint($nombrePoint)
    {
        $this->nombrePoint = $nombrePoint;

        return $this;
    }

    /**
     * Get nombrePoint
     *
     * @return integer
     */
    public function getNombrePoint()
    {
        return $this->nombrePoint;
    }
    
       public function __construct()
  {
        //   $this->dateDebut= new \DateTime();
        //   $this->dateFin = new \DateTime();
    $this->eleveexamens = new ArrayCollection();
    $this->classes = new ArrayCollection();
  }

    /**
     * Add eleveexamen
     *
     * @param \SL\PlateformBundle\Entity\EleveExamen $eleveexamen
     *
     * @return Examen
     */
    public function addEleveexamen(\SL\PlateformBundle\Entity\EleveExamen $eleveexamen)
    {
        $this->eleveexamens[] = $eleveexamen;

        return $this;
    }

    /**
     * Remove eleveexamen
     *
     * @param \SL\PlateformBundle\Entity\EleveExamen $eleveexamen
     */
    public function removeEleveexamen(\SL\PlateformBundle\Entity\EleveExamen $eleveexamen)
    {
        $this->eleveexamens->removeElement($eleveexamen);
    }

    /**
     * Get eleveexamens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEleveexamens()
    {
        return $this->eleveexamens;
    }

    /**
     * Set anneeScolaire
     *
     * @param \SL\PlateformBundle\Entity\Annee_scolaire $anneeScolaire
     *
     * @return Examen
     */
    public function setAnneeScolaire(\SL\PlateformBundle\Entity\Annee_scolaire $anneeScolaire)
    {
        $this->annee_scolaire = $anneeScolaire;

        return $this;
    }

    /**
     * Get anneeScolaire
     *
     * @return \SL\PlateformBundle\Entity\Annee_scolaire
     */
    public function getAnneeScolaire()
    {
        return $this->annee_scolaire;
    }
    

    /**
     * Add class
     *
     * @param \SL\PlateformBundle\Entity\Classe $class
     *
     * @return Examen
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
}
