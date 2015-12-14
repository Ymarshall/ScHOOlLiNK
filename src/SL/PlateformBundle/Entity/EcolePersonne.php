<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SL\PlateformBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * Description of EcolePersonne
 *
 * @author Meledje
 */
/**
 * EcolePersonne
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EcolePersonneRepository")
 */
class EcolePersonne {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Ecole", inversedBy="ecolespersonnes")
   * @ORM\JoinColumn(nullable=false)
   */
    private $ecole;
    
     /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="ecolespersonnes")
   * @ORM\JoinColumn(nullable=false)
   */
    private $personne;
    /**
   * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\Statut", inversedBy="ecolespersonnes")
   * @ORM\JoinColumn(nullable=true)
   */
    private $statut;
    function getId() {
        return $this->id;
    }

    function getEcole() {
        return $this->ecole;
    }

    function getPersonne() {
        return $this->personne;
    }

    function setEcole(Ecole $ecole) {
        $this->ecole = $ecole;
    }

    function setPersonne(User $personne) {
        $this->personne = $personne;
    }



    /**
     * Set statut
     *
     * @param \SL\PlateformBundle\Entity\Statut $statut
     *
     * @return EcolePersonne
     */
    public function setStatut(\SL\PlateformBundle\Entity\Statut $statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return \SL\PlateformBundle\Entity\Statut
     */
    public function getStatut()
    {
        return $this->statut;
    }
}
