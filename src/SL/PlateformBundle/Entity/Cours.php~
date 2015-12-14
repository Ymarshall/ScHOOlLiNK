<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Cours
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\CoursRepository")
 */
class Cours
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EleveCours", mappedBy="cours")
     **/
    private $elevescours;

    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Matiere", inversedBy="cours")
     * @ORM\JoinColumn(nullable=false)
     */
  private $matiere;
 
  function getMatiere() {
      return $this->matiere;
  }


  function setMatiere(Matiere $matiere) {
      $this->matiere = $matiere;
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
     * @var \DateTime
     *
     * @ORM\Column(name="Heure_debut", type="time")
     */
    private $heureDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Heure_fin", type="time")
     */
    private $heureFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_cours", type="date")
     */
    private $dateCours;

    /**
     * @var string
     *
     * @ORM\Column(name="Commentaire", type="text")
     */
    private $commentaire;


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
     * Set heureDebut
     *
     * @param \DateTime $heureDebut
     *
     * @return Cours
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;

        return $this;
    }

    /**
     * Get heureDebut
     *
     * @return \DateTime
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * Set heureFin
     *
     * @param \DateTime $heureFin
     *
     * @return Cours
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;

        return $this;
    }

    /**
     * Get heureFin
     *
     * @return \DateTime
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * Set dateCours
     *
     * @param \DateTime $dateCours
     *
     * @return Cours
     */
    public function setDateCours($dateCours)
    {
        $this->dateCours = $dateCours;

        return $this;
    }

    /**
     * Get dateCours
     *
     * @return \DateTime
     */
    public function getDateCours()
    {
        return $this->dateCours;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Cours
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    
     public function __construct()
  {
    $this->elevescours = new ArrayCollection();
    // ...
  }


  public function getElevescours()
  {
    return $this->elevescours;
  }

    /**
     * Add elevescour
     *
     * @param \SL\PlateformBundle\Entity\EleveCours $elevescour
     *
     * @return Cours
     */
    public function addElevescour(EleveCours $elevescour)
    {
        $this->elevescours[] = $elevescour;

        return $this;
    }

    /**
     * Remove elevescour
     *
     * @param \SL\PlateformBundle\Entity\EleveCours $elevescour
     */
    public function removeElevescour(EleveCours $elevescour)
    {
        $this->elevescours->removeElement($elevescour);
    }
}
