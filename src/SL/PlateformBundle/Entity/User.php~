<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
        /**
   * @ORM\OneToOne(targetEntity="SL\PlateformBundle\Entity\Image", cascade={"persist", "remove"})
     * @Assert\Valid()
   */
  private $image;
  function getImage() {
      return $this->image;
  }

  function setImage(Image $image) {
      $this->image = $image;
  }

 
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Eleve", mappedBy="personne")
     */
     private $eleves;
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Educateur", mappedBy="personne")
     */
     private $educateurs; 
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Professeur", mappedBy="personne")
     */
     private $professeurs; 
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Parents", mappedBy="personne")
     */
     private $parents; 
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Message", mappedBy="emetteur")
     */
     private $messagesemis;
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\EcolePersonne", mappedBy="personne")
     */
     private $ecolespersonnes;
     /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Messages_personne", mappedBy="personne")
     */
     private $messagespersonnes;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Adresse", cascade={"persist"})
     * @Assert\Valid()
     **/
    private $adresse;
    function getAdresse() {
        return $this->adresse;
    }

    function setAdresse(Adresse $adresse) {
        $this->adresse = $adresse;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Sexe")
   * @ORM\JoinColumn(nullable=false)
     **/
    private $sexe;
    function getSexe() {
        return $this->sexe;
    }

    function setSexe(Sexe $sexe) {
        $this->sexe = $sexe;
    }
/**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=128, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Prenoms", type="string", length=255, nullable=true)
     */
    private $prenoms;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_naissance", type="date")
     * @Assert\DateTime()
     */
    private $dateNaissance;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=12, unique=true, nullable=true)
     * @Assert\Length(min=8, minMessage ="Le format incorrect.")
     */
    private $telephone;

     /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateCreation", type="date", nullable=true)
     * @Assert\DateTime()
     */
    private $dateCreation;
    function getDateCreation() {
        return $this->dateCreation;
    }

    function setDateCreation(\DateTime $dateCreation) {
        $this->dateCreation = $dateCreation;
    }

    
    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return User
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenoms
     *
     * @param string $prenoms
     *
     * @return User
     */
    public function setPrenoms($prenoms)
    {
        $this->prenoms = $prenoms;

        return $this;
    }

    /**
     * Get prenoms
     *
     * @return string
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return User
     */
    public function setDateNaissance(\DateTime $dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     *
     * @return User
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
    
    
     public function __construct()
  {        
    parent::__construct();
    $this->dateCreation = new \Datetime();
    $this->messagesemis = new ArrayCollection();    
    $this->eleves = new ArrayCollection();
    $this->parents = new ArrayCollection();
    $this->educateurs = new ArrayCollection();
    $this->professeurs = new ArrayCollection();
    $this->ecolespersonnes = new ArrayCollection();
    $this->messagespersonnes = new ArrayCollection();
  }
  
  public function addMessageemi(Message $message)
  {
    $this->messagesemis[] = $message;

    return $this;
  }

  public function removeMessageemi(Message $message)
  {
    $this->messagesemis->removeElement($message);
  }

  public function getMessageemis()
  {
    return $this->messagesrecus;
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
  
  public function addEducateur(Educateur $educateur)
  {
    
    $this->educateurs[] = $educateur;

    return $this;
  }

  public function removeEducateur(Educateur $educateur)
  {
    $this->educateurs->removeElement($educateur);
  }

  public function getEducateurs()
  {
    return $this->educateurs;
  }
  
  public function addParent(Parents $parent)
  {
    
    $this->parents[] = $parent;

    return $this;
  }

  public function removeParent(Parents $parent)
  {
    $this->parents->removeElement($parent);
  }

  public function getParents()
  {
    return $this->parents;
  }
  public function addProfesseur(Professeur $professseur)
  {
    
    $this->professeurs[] = $professseur;

    return $this;
  }

  public function removeProfesseur(Professeur $professseur)
  {
    $this->professeurs->removeElement($professseur);
  }

  public function getProfesseurs()
  {
    return $this->professeurs;
  }

    /**
     * Add elefe
     *
     * @param \SL\PlateformBundle\Entity\Eleve $elefe
     *
     * @return User
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

    /**
     * Add messagesemi
     *
     * @param \SL\PlateformBundle\Entity\Message $messagesemi
     *
     * @return User
     */
    public function addMessagesemi(\SL\PlateformBundle\Entity\Message $messagesemi)
    {
        $this->messagesemis[] = $messagesemi;

        return $this;
    }

    /**
     * Remove messagesemi
     *
     * @param \SL\PlateformBundle\Entity\Message $messagesemi
     */
    public function removeMessagesemi(\SL\PlateformBundle\Entity\Message $messagesemi)
    {
        $this->messagesemis->removeElement($messagesemi);
    }

    /**
     * Get messagesemis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMessagesemis()
    {
        return $this->messagesemis;
    }

    
    public function getNomPrenoms(){
        return $this->nom.' '.$this->prenoms;
    }
    
    public function __toString() {
        return $this->nom .' '.$this->prenoms;
    }
    

    /**
     * Add ecolespersonne
     *
     * @param \SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne
     *
     * @return User
     */
    public function addEcolespersonne(\SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne)
    {
        $this->ecolespersonnes[] = $ecolespersonne;

        return $this;
    }

    /**
     * Remove ecolespersonne
     *
     * @param \SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne
     */
    public function removeEcolespersonne(\SL\PlateformBundle\Entity\EcolePersonne $ecolespersonne)
    {
        $this->ecolespersonnes->removeElement($ecolespersonne);
    }

    /**
     * Get ecolespersonnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEcolespersonnes()
    {
        return $this->ecolespersonnes;
    }
    
    public function addMessagespersonne(User $messagespersonnes)
    {
        $this->messagespersonnes[] = $messagespersonnes;

        return $this;
    }

    public function removeMessagespersonne(User $messagespersonnes)
    {
        $this->messagespersonnes->removeElement($messagespersonnes);
    }

    public function getMessagespersonnes()
    {
        return $this->messagespersonnes;
    }
}
