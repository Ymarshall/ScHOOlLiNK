<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Emploi_temps
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Emploi_tempsRepository")
 */
class Emploi_temps
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Composant", mappedBy="emploi_temps")
     */
     private $composants; 
     
     /**
     * @ORM\OneToOne(targetEntity="SL\PlateformBundle\Entity\Classe", mappedBy="emploi_temps")
     */
     private $classes; 
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
     * @ORM\Column(name="Libelle", type="string", length=128)
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
     * @return Emploi_temps
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
    $this->composants = new ArrayCollection();
    $this->classes=new ArrayCollection();
    // ...
  }

  public function addComposant(Composant $composant)
  {
    
    $this->composants[] = $composant;

    return $this;
  }

  public function removeComposant(Composant $composant)
  {
    $this->composants->removeElement($composant);
  }

  public function getComposants()
  {
    return $this->composants;
  }
  
  public function addClasse(Classe $classe)
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
     * @return Emploi_temps
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
     * Set classes
     *
     * @param \SL\PlateformBundle\Entity\Classe $classes
     *
     * @return Emploi_temps
     */
    public function setClasses(\SL\PlateformBundle\Entity\Classe $classes = null)
    {
        $this->classes = $classes;

        return $this;
    }
}
