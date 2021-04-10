<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Visiteur
 *
 * @ORM\Table(name="VISITEUR")
 * @ORM\Entity(repositoryClass="App\Repository\VisiteurRepository")
 */
class Visiteur implements UserInterface, \Serializable

{
    /**
     * @var string
     *
     * @ORM\Column(name="IDENTIFIANT", type="string", length=255, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identifiant;

    /**
     * @var string
     *
     * @ORM\Column(name="MDP", type="string", length=255, nullable=false)
     */
    private $mdp;

    /**
     * @var string
     *
     * @ORM\Column(name="NOM", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="PRENOM", type="string", length=255, nullable=false)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="TEL", type="string", length=255, nullable=false)
     */
    private $tel;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="COMPTABLE", type="boolean", nullable=true)
     */
    private $comptable;

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }
    public function getUsername(): ?string
    {
        return $this->identifiant;
    }
    public function getMdp(): ?string
    {
        return $this->mdp;
    }
    public function getPassword(): ?string
    {
        return $this->mdp;
    }

    public function setMdp(string $mdp): self
    {
        $this->mdp = $mdp;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getComptable(): ?bool
    {
        return $this->comptable;
    }

    public function setComptable(?bool $comptable): self
    {
        $this->comptable = $comptable;

        return $this;
    }

    public function getSalt()
    //Peut être utilise dans certaines methodes dechiffrement.
    //On ne l’utilisera pas ici donc on renvoie null
    {
        return null
    ;}

    public function getRoles()
 // Cette méthode renvoie la liste des rôles de l’utilisateur
 // dans notre cas, on ne gère pas plusieurs rôles donc on va simplement renvoyer un tableau avec le role administrateur (ROLE_ADMIN)
 {
 return array('ROLE_ADMIN');
 }

 public function eraseCredentials()
 // Peut permettre de supprimer des informations sensibles qui auraient été stockées dans l’entité
 // Dans notre cas, il n’y a pas d’informations sensibles donc on laisse le corps de cette méthode vide
 {
 }

 /** @see \Serializable::serialize() */
 public function serialize()
 // Fonction qui sert à transformer notre objet en chaîne
 {
 return serialize(array(
 $this->identifiant,
 $this->identifiant,
 $this->mdp,
 ));
 }

 /** @see \Serializable::unserialize() */
 public function unserialize($serialized)
 // Fonction qui sert à convertir une chaîne en objet
 {
 list(
 $this->identifiant,
 $this->identifiant,
 $this->mdp,
 ) = unserialize($serialized);
 }




}
