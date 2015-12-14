<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Parents
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ParentsRepository")
 */
class Parents
{
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="parents", cascade={"persist"})
     * @ORM\JoinColumn(name="personne_id", referencedColumnName="id", nullable=true)
     **/
    private $personne;
    function getPersonne() {
        return $this->personne;
    }

    function setPersonne(User $personne) {
        $this->personne = $personne;
    }
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Eleve", mappedBy="parent")
     */
     private $eleves; 
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
     * @ORM\Column(name="Situation_matri", type="string", length=64)
     */
    private $situationMatri;


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
     * Set situationMatri
     *
     * @param string $situationMatri
     *
     * @return Parents
     */
    public function setSituationMatri($situationMatri)
    {
        $this->situationMatri = $situationMatri;

        return $this;
    }

    /**
     * Get situationMatri
     *
     * @return string
     */
    public function getSituationMatri()
    {
        return $this->situationMatri;
    }
    
    public function __construct()
  {
    $this->eleves = new ArrayCollection();
    // ...
  }

  public function addEleve(Eleve $eleve)
  {
    
    $this->eleves[] = $eleve;

    return $this;
  }

  public function removeEleve(Eleve $eleve)
  {
    $this->eleves->removeElement($eleve);
  }

  public function getEleves()
  {
    return $this->eleves;
  }

    /**
     * Add elefe
     *
     * @param \SL\PlateformBundle\Entity\Eleve $elefe
     *
     * @return Parents
     */
    public function addElefe(\SL\PlateformBundle\Entity\Eleve $elefe)
    {
        $this->eleves[] = $elefe;

        return $this;
    }

    /**
     * Remove elefe
     *
     * @param \SL\PlateformBundle\Entity\Eleve $elefe
     */
    public function removeElefe(\SL\PlateformBundle\Entity\Eleve $elefe)
    {
        $this->eleves->removeElement($elefe);
    }
}
