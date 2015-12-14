<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Annee_scolaire
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Annee_scolaireRepository")
 */
class Annee_scolaire
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Classe", mappedBy="annee_scolaire")
     */
     private $classes;
     
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Examen", mappedBy="annee_scolaire")
     */
     private $examens;
     
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
     * @ORM\Column(name="Debut", type="string", length=4, unique=true)
     * @Assert\Length(min=8)
     */
    private $debut;
    
        /**
     * @var string
     *
     * @ORM\Column(name="Fin", type="string", length=4, unique=true)
     * @Assert\Length(min=8)
     */
    private $fin;

    function getDebut() {
        return $this->debut;
    }

    function getFin() {
        return $this->fin;
    }

    function setDebut($debut) {
        $this->debut = $debut;
    }

    function setFin($fin) {
        $this->fin = $fin;
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

    
    
     public function __construct()
  {
    $this->classes = new ArrayCollection();
    $this->examens = new ArrayCollection();
  }

  public function addClasse(Classe $classe = null)
  {
    $this->classes[] = $classe;

    return $this;
  }

  public function removeClasse(Classe $classe)
  {
    $this->classes->removeElement($classe);
  }

  public function getClasses()
  {
    return $this->classes;
  }

    /**
     * Add class
     *
     * @param \SL\PlateformBundle\Entity\Classe $class
     *
     * @return Annee_scolaire
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
    
    public function getLibelle() {
        return $this->debut.' - '.$this->fin;
    }

    /**
     * Add examen
     *
     * @param \SL\PlateformBundle\Entity\Examen $examen
     *
     * @return Annee_scolaire
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
