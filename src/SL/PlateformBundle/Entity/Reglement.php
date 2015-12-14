<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reglement
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ReglementRepository")
 */
class Reglement
{
    
     /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Type_reglement", inversedBy="reglements")
   * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
   */
  private $type_reglement;
   /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Mois", inversedBy="reglements")
   * @ORM\JoinColumn(name="mois_id", referencedColumnName="id", nullable=false)
   */
  private $mois;
   /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Classe", inversedBy="reglements")
   * @ORM\JoinColumn(name="classe_id", referencedColumnName="id", nullable=false)
   */
  private $classe;
  function getType_reglement() {
      return $this->type_reglement;
  }

  function getMois() {
      return $this->mois;
  }

  function getClasse() {
      return $this->classe;
  }

  function setType_reglement(Type_reglement $type_reglement) {
      $this->type_reglement = $type_reglement;
  }

  function setMois(Mois $mois) {
      $this->mois = $mois;
  }

  function setClasse(Classe $classe) {
      $this->classe = $classe;
  }

      /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="Montant", type="integer")
     */
    private $montant;

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
     * Set montant
     *
     * @param integer $montant
     *
     * @return Reglement
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;

        return $this;
    }

    /**
     * Get montant
     *
     * @return integer
     */
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Reglement
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
     * Set typeReglement
     *
     * @param \SL\PlateformBundle\Entity\Type_reglement $typeReglement
     *
     * @return Reglement
     */
    public function setTypeReglement(\SL\PlateformBundle\Entity\Type_reglement $typeReglement)
    {
        $this->type_reglement = $typeReglement;

        return $this;
    }

    /**
     * Get typeReglement
     *
     * @return \SL\PlateformBundle\Entity\Type_reglement
     */
    public function getTypeReglement()
    {
        return $this->type_reglement;
    }
}
