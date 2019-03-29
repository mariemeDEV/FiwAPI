<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Transaction;

/**
 * Compte
 *
 * @ORM\Table(name="compte", indexes={@ORM\Index(name="id_utilisateur", columns={"id_utilisateur"})})
 * @ORM\Entity
 */
class Compte
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_compte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCompte;

    /**
     * @var int
     *
     * @ORM\Column(name="solde", type="integer", nullable=false)
     */
    private $solde;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_utilisateur", referencedColumnName="id")
     * })
     */
    private $idUtilisateur;


    //   /****
    //  * @ORM\ManyToMany(targetEntity="EntityB", mappedBy="as")
    //  */
    // protected $bs;

    //         /****
    //  * @ORM\ManyToMany(targetEntity="EntityA", inversedBy="bs")
    //  */
    // protected $as;


     /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="compte")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    /**
     * Get the value of idCompte
     *
     * @return  int
     */ 
    public function getIdCompte()
    {
        return $this->idCompte;
    }

    /**
     * Get the value of solde
     *
     * @return  int
     */ 
    public function getSolde()
    {
        return $this->solde;
    }

    /**
     * Set the value of solde
     *
     * @param  int  $solde
     *
     * @return  self
     */ 
    public function setSolde(int $solde)
    {
        $this->solde = $solde;

        return $this;
    }

    /**
     * Get the value of points
     *
     * @return  int
     */ 
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set the value of points
     *
     * @param  int  $points
     *
     * @return  self
     */ 
    public function setPoints(int $points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get the value of idUtilisateur
     *
     * @return  \Utilisateur
     */ 
    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }

    /**
     * Set the value of idUtilisateur
     * @return  self
     */ 
    public function setIdUtilisateur($idUtilisateur)
    {
        $this->idUtilisateur = $idUtilisateur;
        return $this;
    }
}
