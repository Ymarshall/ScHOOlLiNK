<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Professeur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ProfesseurRepository")
 */
class Professeur
{
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="professeurs", cascade={"persist"})
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
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EcoleProfesseur", mappedBy="professeur")
     **/
    private $ecoleprofesseurs;
    
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\ProfesseurMatiere", mappedBy="professeur", cascade={"persist"})
     **/
    private $professeurmatieres;
    
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
     * @ORM\Column(name="Matricule", type="string", length=64)
     */
    private $matricule;


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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Professeur
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }
    
     public function __construct()
  {
    $this->ecoleprofesseurs = new ArrayCollection();
    $this->professeurmatieres= new ArrayCollection();
    // ...
  }

  public function addEcoleprofesseur(EcoleProfesseur $ecoleprofesseur)
  {
    $this->ecoleprofesseurs[] = $ecoleprofesseur;

    return $this;
  }

  public function removeEcoleprofesseur(EcoleProfesseur $ecoleprofesseur)
  {
    $this->ecoleprofesseurs->removeElement($ecoleprofesseur);
  }

  public function getEcoleprofesseurs()
  {
    return $this->ecoleprofesseurs;
  }
  
   public function addProfesseurmatiere(ProfesseurMatiere $professeurmatiere)
  {
    $this->professeurmatieres[] = $professeurmatiere;

    return $this;
  }

  public function removeProfesseurmatiere(ProfesseurMatiere $professeurmatiere)
  {
    $this->professeurmatieres->removeElement($professeurmatiere);
  }

  public function getProfesseurmatieres()
  {
    return $this->professeurmatieres;
  }
  
  public function getInformation() {
      return $this->personne;
  }
  
}
