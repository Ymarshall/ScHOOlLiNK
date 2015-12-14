<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mois
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\MoisRepository")
 */
class Mois
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Reglement", mappedBy="mois")
     */
     private $reglements;
     
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
     * @ORM\Column(name="Libelle", type="string", length=32)
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
     * @return Mois
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
    $this->reglements = new ArrayCollection();
  }

    /**
     * Add reglement
     *
     * @param \SL\PlateformBundle\Entity\Reglement $reglement
     *
     * @return Mois
     */
    public function addReglement(\SL\PlateformBundle\Entity\Reglement $reglement)
    {
        $this->reglements[] = $reglement;

        return $this;
    }

    /**
     * Remove reglement
     *
     * @param \SL\PlateformBundle\Entity\Reglement $reglement
     */
    public function removeReglement(\SL\PlateformBundle\Entity\Reglement $reglement)
    {
        $this->reglements->removeElement($reglement);
    }

    /**
     * Get reglements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReglements()
    {
        return $this->reglements;
    }
}
