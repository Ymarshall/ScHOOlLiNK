<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Statut
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\StatutRepository")
 */
class Statut
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EcolePersonne", mappedBy="statut")
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
     * @ORM\Column(name="Libelle", type="string", length=64,unique=true)
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
     * @return Statut
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
    $this->ecolespersonnes = new ArrayCollection();
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

    /**
     * Add ecolespersonne
     *
     * @param \SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne
     *
     * @return Statut
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
}
