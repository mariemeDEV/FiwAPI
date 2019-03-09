<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction", indexes={@ORM\Index(name="id_type", columns={"id_type"}), @ORM\Index(name="id_compte", columns={"id_compte"})})
 * @ORM\Entity
 */
class Transaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_transaction", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idTransaction;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_transaction", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantTransaction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_transaction", type="date", nullable=false)
     */
    private $dateTransaction;

    /**
     * @var \Compte
     *
     * @ORM\ManyToOne(targetEntity="Compte")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_compte", referencedColumnName="id_compte")
     * })
     */
    private $idCompte;

    /**
     * @var \Typedetransaction
     *
     * @ORM\ManyToOne(targetEntity="Typedetransaction")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_type", referencedColumnName="id_type")
     * })
     */
    private $idType;

      /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="transaction")
     */
    private $compte;

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    /**
     * Get the value of idTransaction
     *
     * @return  int
     */ 
    public function getIdTransaction()
    {
        return $this->idTransaction;
    }

    /**
     * Get the value of montantTransaction
     *
     * @return  float
     */ 
    public function getMontantTransaction()
    {
        return $this->montantTransaction;
    }

    /**
     * Set the value of montantTransaction
     *
     * @param  float  $montantTransaction
     *
     * @return  self
     */ 
    public function setMontantTransaction(float $montantTransaction)
    {
        $this->montantTransaction = $montantTransaction;

        return $this;
    }

    /**
     * Get the value of dateTransaction
     *
     * @return  \DateTime
     */ 
    public function getDateTransaction()
    {
        return $this->dateTransaction;
    }

    /**
     * Set the value of dateTransaction
     *
     * @param  \DateTime  $dateTransaction
     *
     * @return  self
     */ 
    public function setDateTransaction(\DateTime $dateTransaction)
    {
        $this->dateTransaction = $dateTransaction;

        return $this;
    }

    /**
     * Set the value of idCompte
     *
     * @param  \Compte  $idCompte
     *
     * @return  self
     */ 
    public function setIdCompte(\Compte $idCompte)
    {
        $this->idCompte = $idCompte;

        return $this;
    }

    /**
     * Get the value of idType
     *
     * @return  \Typedetransaction
     */ 
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Set the value of idType
     *
     * @param  \Typedetransaction  $idType
     *
     * @return  self
     */ 
    public function setIdType(\Typedetransaction $idType)
    {
        $this->idType = $idType;

        return $this;
    }
}
