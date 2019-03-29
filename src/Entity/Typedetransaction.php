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


}
