<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
/**
 * Composant
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="composant_empl", columns={"Heure_debut", "Heure_fin","jour_id","emploi_temps_id"})})
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\ComposantRepository")
 */
class Composant
{
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Matiere", inversedBy="composants")
     * @ORM\JoinColumn(nullable=false)
     */
  private $matiere;
  function getMatiere() {
      return $this->matiere;
  }

  function getEmploitemps() {
      return $this->emploi_temps;
  }

  function setMatiere($matiere) {
      $this->matiere = $matiere;
  }

  function setEmploitemps(Emploi_temps $emploi_temps) {
      $this->emploi_temps = $emploi_temps;
  }

      /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Jour", inversedBy="composants")
     * @ORM\JoinColumn(nullable=false)
     */
  private $jour;
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Emploi_temps", inversedBy="composants")
     * @ORM\JoinColumn(nullable=false)
     */
  private $emploi_temps;

  function getJour() {
      return $this->jour;
  }

  function setJour(Jour $jour) {
      $this->jour = $jour;
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
     * @return Composant
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
     * @return Composant
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

}
