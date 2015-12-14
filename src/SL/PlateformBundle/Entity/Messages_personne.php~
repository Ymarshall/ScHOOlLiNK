<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages_personne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\Messages_personneRepository")
 */
class Messages_personne
{
    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Message", inversedBy="messagespersonnes")
   * @ORM\JoinColumn(name="message_id", referencedColumnName="id",nullable=false)
   */
    private $message;
    
     /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="messagespersonnes")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id",nullable=false)
   */
    private $personne;
    function getMessage() {
        return $this->message;
    }

    function getPersonne() {
        return $this->personne;
    }

    function setMessage(Message $message) {
        $this->message = $message;
    }

    function setPersonne(User $personne) {
        $this->personne = $personne;
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
     * @var boolean
     *
     * @ORM\Column(name="Statut", type="boolean")
     */
    private $statut;


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
     * Set statut
     *
     * @param string $statut
     *
     * @return Messages_personne
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
    
     public function __construct()
  {
    $this->statut=false;

  }
}
