<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Justificatif
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\JustificatifRepository")
 */
class Justificatif
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
     * @var \DateTime
     *
     * @ORM\Column(name="Date_justificatif", type="date")
     */
    private $dateJustificatif;

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="text")
     */
    private $contenu;


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
     * Set dateJustificatif
     *
     * @param \DateTime $dateJustificatif
     *
     * @return Justificatif
     */
    public function setDateJustificatif($dateJustificatif)
    {
        $this->dateJustificatif = $dateJustificatif;

        return $this;
    }

    /**
     * Get dateJustificatif
     *
     * @return \DateTime
     */
    public function getDateJustificatif()
    {
        return $this->dateJustificatif;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Justificatif
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
    
  
}
