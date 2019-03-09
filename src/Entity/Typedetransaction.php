<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Typedetransaction
 *
 * @ORM\Table(name="typeDeTransaction")
 * @ORM\Entity
 */
class Typedetransaction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_type", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idType;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle_type", type="string", length=0, nullable=false)
     */
    private $libelleType;



    /**
     * Get the value of idType
     *
     * @return  int
     */ 
    public function getIdType()
    {
        return $this->idType;
    }

    /**
     * Get the value of libelleType
     *
     * @return  string
     */ 
    public function getLibelleType()
    {
        return $this->libelleType;
    }

    /**
     * Set the value of libelleType
     *
     * @param  string  $libelleType
     *
     * @return  self
     */ 
    public function setLibelleType(string $libelleType)
    {
        $this->libelleType = $libelleType;

        return $this;
    }
}
