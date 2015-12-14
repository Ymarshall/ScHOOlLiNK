<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Jour
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\JourRepository")
 */
class Jour
{
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Composant", mappedBy="jour")
     */
     private $composants; 
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
     * @ORM\Column(name="Libelle", type="string",unique=true, length=16)
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
     * @return Jour
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
}
