<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Utilisateur;

/**
 * Chauffeur
 *
 * @ORM\Table(name="chauffeur", indexes={@ORM\Index(name="login", columns={"login"})})
 * @ORM\Entity
 */
class Chauffeur extends Utilisateur
{
    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=20, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $matricule;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="login", referencedColumnName="login")
     * })
     */
    private $login;


    // public function __construct($login){
    //    $this->login = $login;
    // }

    /**
     * Get the value of matricule
     *
     * @return  string
    */ 
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set the value of matricule
     *
     * @param  string  $matricule
     *
     * @return  self
    */ 
    public function setMatricule(string $matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }
  

}
