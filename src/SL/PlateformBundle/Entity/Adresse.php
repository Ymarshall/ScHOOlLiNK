<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Adresse
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\AdresseRepository")
 */
class Adresse
{
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
     * @ORM\Column(name="Ville", type="string", length=64)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="Commune", type="string", length=64)
     */
    private $commune;

    /**
     * @var string
     *
     * @ORM\Column(name="Quartier", type="string", length=64)
     */
    private $quartier;
    
        /**
     * @var string
     *
     * @ORM\Column(name="Adresse", type="string", length=64,nullable=true)
     */
    private $adresse;
    function getAdresse() {
        return $this->adresse;
    }

    function setAdresse($adresse) {
        $this->adresse = $adresse;
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set commune
     *
     * @param string $commune
     *
     * @return Adresse
     */
    public function setCommune($commune)
    {
        $this->commune = $commune;

        return $this;
    }

    /**
     * Get commune
     *
     * @return string
     */
    public function getCommune()
    {
        return $this->commune;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     *
     * @return Adresse
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string
     */
    public function getQuartier()
    {
        return $this->quartier;
    }
    
    
}
