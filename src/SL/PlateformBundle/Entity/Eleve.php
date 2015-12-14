<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Eleve
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EleveRepository")
 */
class Eleve
{
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EleveExamen", mappedBy="eleve")
     **/
    private $eleveexamens;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Notes", mappedBy="eleve")
     **/
    private $notes;
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Details_cr", mappedBy="eleve")
     */
     private $details_crs;
     
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="eleves", cascade={"persist"})
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
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Parents", inversedBy="eleves")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     **/
    private $parent;
    function getParent() {
        return $this->parent;
    }

    function setParent(Parents $parent) {
        $this->parent = $parent;
    }

   /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Classe", inversedBy="eleves")
     * @ORM\JoinColumn(name="classe_id", referencedColumnName="id", nullable=false)
     **/
    private $classe;
    function getClasse() {
        return $this->classe;
    }

    function setClasse(Classe $classe) {
        $this->classe = $classe;
    }

    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EleveCours", mappedBy="eleve")
     **/
    private $elevescours;
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
     * @ORM\Column(name="Matricule", type="string",unique=true, length=64)
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
     * @return Eleve
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
    $this->elevescours = new ArrayCollection();
     $this->details_crs=new ArrayCollection();
     $this->notes = new ArrayCollection();
    $this->eleveexamens = new ArrayCollection();
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
  
  public function getElevesCours()
  {
    return $this->elevescours;
  }
     

    /**
     * Add detailsCr
     *
     * @param \SL\PlateformBundle\Entity\Details_cr $detailsCr
     *
     * @return Eleve
     */
    public function addDetailsCr(Details_cr $detailsCr)
    {
        $this->details_crs[] = $detailsCr;

        return $this;
    }

    /**
     * Remove detailsCr
     *
     * @param \SL\PlateformBundle\Entity\Details_cr $detailsCr
     */
    public function removeDetailsCr(Details_cr $detailsCr)
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

    /**
     * Add elevescour
     *
     * @param \SL\PlateformBundle\Entity\EleveCours $elevescour
     *
     * @return Eleve
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
    

    /**
     * Add eleveexamen
     *
     * @param \SL\PlateformBundle\Entity\EleveExamen $eleveexamen
     *
     * @return Eleve
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
