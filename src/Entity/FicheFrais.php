<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Etat;
use App\Entity\Forfaitaire;
use App\Entity\HorsForfait;
use App\Entity\Type;

/**
 * FicheFrais
 *
 * @ORM\Table(name="FICHE_FRAIS", indexes={@ORM\Index(name="I_FK_FICHE_FRAIS_ETAT", columns={"ID_ETAT"}), @ORM\Index(name="I_FK_FICHE_FRAIS_VISITEUR", columns={"IDENTIFIANT"})})
 * @ORM\Entity(repositoryClass="App\Repository\FicheFraisRepository")
 */
class FicheFrais
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_FICHE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFiche;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Etat|5
     *
     * @ORM\ManyToOne(targetEntity="Etat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_ETAT", referencedColumnName="ID_ETAT")
     * })
     */
    private $idEtat;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IDENTIFIANT", referencedColumnName="IDENTIFIANT")
     * })
     */
    private $identifiant;

    public function getIdFiche(): ?int
    {
        return $this->idFiche;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getIdEtat(): ?Etat
    {
        return $this->idEtat;
    }

    public function setIdEtat(?Etat $idEtat): self
    {
        $this->idEtat = $idEtat;

        return $this;
    }

    public function getIdentifiant(): ?Visiteur
    {
        return $this->identifiant;
    }

    public function setIdentifiant(?Visiteur $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }


}
