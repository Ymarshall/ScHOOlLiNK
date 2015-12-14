<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Type_details_cr
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Type_details_crRepository")
 */
class Type_details_cr
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Details_cr", mappedBy="type_details_cr")
     */
     private $details_crs;
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
     * @ORM\Column(name="Libelle", type="string",unique=true, length=64)
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
     * @return Type_details_cr
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
    $this->details_crs = new ArrayCollection();
    // ...
  }

  public function addDetails_cr(Details_cr $details)
  {
    
    $this->details_crs[] = $details;

    return $this;
  }

  public function removeDetails_cr(Details_cr $details)
  {
    $this->details_crs->removeElement($details);
  }

  public function getDetails_crs()
  {
    return $this->details_crs;
  }

    /**
     * Add detailsCr
     *
     * @param \SL\PlateformBundle\Entity\Details_cr $detailsCr
     *
     * @return Type_details_cr
     */
    public function addDetailsCr(\SL\PlateformBundle\Entity\Details_cr $detailsCr)
    {
        $this->details_crs[] = $detailsCr;

        return $this;
    }

    /**
     * Remove detailsCr
     *
     * @param \SL\PlateformBundle\Entity\Details_cr $detailsCr
     */
    public function removeDetailsCr(\SL\PlateformBundle\Entity\Details_cr $detailsCr)
    {
        $this->details_crs->removeElement($detailsCr);
    }

    /**
     * Get detailsCrs
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDetailsCrs()
    {
        return $this->details_crs;
    }
}
