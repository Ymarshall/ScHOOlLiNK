<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Matiere
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\MatiereRepository")
 */
class Matiere
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\ProfesseurMatiere", mappedBy="matiere")
     **/
    private $professeurmatieres;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EleveExamen", mappedBy="matiere")
     **/
    private $eleveexamens;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Composant", mappedBy="matiere")
     */
     private $composants; 
      /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Notes", mappedBy="matiere")
     */
     private $notes; 
     
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Cours", mappedBy="matiere")
     */
     private $cours; 
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
     * @ORM\Column(name="Libelle", type="string",unique=true, length=128)
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
     * @return Matiere
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
    $this->professeurmatieres = new ArrayCollection();
    $this->cours= new ArrayCollection();
    $this->notes = new ArrayCollection();
    $this->eleveexamens = new ArrayCollection();
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
  
   public function addCour(Cours $cours)
  {
    
    $this->cours[] = $cours;

    return $this;
  }

  public function removeCour(Composant $cours)
  {
    $this->cours->removeElement($cours);
  }

  public function getCours()
  {
    return $this->cours;
  }
  
    public function addNote(Notes $notes)
  {
    $this->notes[] = $notes;

    return $this;
  }

  public function removeNote(Notes $notes)
  {
    $this->notes->removeElement($notes);
  }

  public function getNotes()
  {
    return $this->notes;
  }
  
  public function getMatiere($id) {
	return $this->getRepository('SLPlaterformBundle:Matiere')->getMatieresByUser($id);
}

    /**
     * Add eleveexamen
     *
     * @param \SL\PlateformBundle\Entity\EleveExamen $eleveexamen
     *
     * @return Matiere
     */
    public function addEleveexamen(\SL\PlateformBundle\Entity\EleveExamen $eleveexamen)
    {
        $this->eleveexamens[] = $eleveexamen;

        return $this;
    }

    /**
     * Remove eleveexamen
     *
     * @param \SL\PlateformBundle\Entity\EleveExamen $eleveexamen
     */
    public function removeEleveexamen(\SL\PlateformBundle\Entity\EleveExamen $eleveexamen)
    {
        $this->eleveexamens->removeElement($eleveexamen);
    }

    /**
     * Get eleveexamens
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEleveexamens()
    {
        return $this->eleveexamens;
    }
}
