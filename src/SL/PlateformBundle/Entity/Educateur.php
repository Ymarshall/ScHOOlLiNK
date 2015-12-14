<?php

namespace SL\PlateformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Educateur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SL\PlateformBundle\Entity\EducateurRepository")
 */
class Educateur
{
    /**
     * @ORM\ManyToOne(targetEntity="SL\PlateformBundle\Entity\User", inversedBy="educateurs", cascade={"persist"})
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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
