<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Compte
 *
 * @ORM\Table(name="compte", uniqueConstraints={@ORM\UniqueConstraint(name="login_user", columns={"login_user"})})
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
     *   @ORM\JoinColumn(name="login_user", referencedColumnName="login")
     * })
     */
    private $loginUser;

       /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="compte")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = array();
    }

    /**
     * @return transactions[]
     */
    public function getTransactions()
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
}
