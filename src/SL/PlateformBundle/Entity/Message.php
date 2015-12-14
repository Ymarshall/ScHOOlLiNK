<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Message
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\MessageRepository")
 */
class Message
{
    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="messagesemis")
   * @ORM\JoinColumn(name="emetteur_id", referencedColumnName="id", nullable=false)
   */
  private $emetteur;
  function getEmetteur() {
      return $this->emetteur;
  }

  function setEmetteur(User $emetteur) {
      $this->emetteur = $emetteur;
  }
  
    /**
     * @ORM\OneToMany(targetEntity="SL\PlateformBundle\Entity\Messages_personne", mappedBy="message")
     **/
    private $messagespersonnes;


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
     * @ORM\Column(name="Objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_message", type="datetime")
     * @Assert\DateTime()
     */
    private $dateMessage;

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
     * Set objet
     *
     * @param string $objet
     *
     * @return Message
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set dateMessage
     *
     * @param \DateTime $dateMessage
     *
     * @return Message
     */
    public function setDateMessage($dateMessage)
    {
        $this->dateMessage = $dateMessage;

        return $this;
    }

    /**
     * Get dateMessage
     *
     * @return \DateTime
     */
    public function getDateMessage()
    {
        return $this->dateMessage;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Message
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
    
   public function __construct()
  {
    $this->messagespersonnes = new ArrayCollection();
    $this->dateMessage = new \Datetime();
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
