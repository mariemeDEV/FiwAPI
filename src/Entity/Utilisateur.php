<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur", uniqueConstraints={@ORM\UniqueConstraint(name="motDePasse", columns={"motDePasse"})})
 * @ORM\Entity
 */
class Utilisateur
{
    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=10, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=20, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=20, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=40, nullable=false)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=30, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=20, nullable=false)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="blob", length=65535, nullable=false)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="motDePasse", type="string", length=30, nullable=false)
     */
    private $motdepasse;

    

     /**
     * Set the value of login
     *
     * @param  string  $login
     *
     * @return  self
     */ 
    public function setLogin(string $login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get the value of nom
     *
     * @return  string
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string  $nom
     *
     * @return  self
     */ 
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of prenom
     *
     * @return  string
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @param  string  $prenom
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of adresse
     *
     * @return  string
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of adresse
     *
     * @param  string  $adresse
     *
     * @return  self
     */ 
    public function setAdresse(string $adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get the value of telephone
     *
     * @return  string
     */ 
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set the value of telephone
     *
     * @param  string  $telephone
     *
     * @return  self
     */ 
    public function setTelephone(string $telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get the value of pays
     *
     * @return  string
     */ 
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set the value of pays
     *
     * @param  string  $pays
     *
     * @return  self
     */ 
    public function setPays(string $pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get the value of photo
     *
     * @return  string
     */ 
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set the value of photo
     *
     * @param  string  $photo
     *
     * @return  self
     */ 
    public function setPhoto(string $photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get the value of motdepasse
     *
     * @return  string
     */ 
    public function getMotdepasse()
    {
        return $this->motdepasse;
    }

    /**
     * Set the value of motdepasse
     *
     * @param  string  $motdepasse
     *
     * @return  self
     */ 
    public function setMotdepasse(string $motdepasse)
    {
        $this->motdepasse = $motdepasse;

        return $this;
    }

   
}
