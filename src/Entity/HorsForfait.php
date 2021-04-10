<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HorsForfait
 *
 * @ORM\Table(name="HORS_FORFAIT", indexes={@ORM\Index(name="I_FK_HORS_FORFAIT_FICHE_FRAIS", columns={"ID_FICHE"})})
 * @ORM\Entity(repositoryClass="App\Repository\HorsForfaitRepository")
 */
class HorsForfait
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_HORSFORFAIT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHorsforfait;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DATE", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="LIBELLE", type="string", length=1000, nullable=false)
     */
    private $libelle;

    /**
     * @var int
     *
     * @ORM\Column(name="NUM_FACTURE", type="integer", nullable=true)
     */
    private $numFacture;

    /**
     * @var int
     *
     * @ORM\Column(name="MONTANT", type="integer", nullable=false)
     */
    private $montant;

    /**
     * @var bool
     *
     * @ORM\Column(name="VALIDATION", type="boolean", nullable=true)
     */
    private $validation=0;

    /**
     * @var \FicheFrais
     *
     * @ORM\ManyToOne(targetEntity="FicheFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_FICHE", referencedColumnName="ID_FICHE")
     * })
     */
    private $idFiche;

    public function getIdHorsforfait(): ?int
    {
        return $this->idHorsforfait;
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

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getNumFacture(): ?int
    {
        return $this->numFacture;
    }

    public function setNumFacture(int $numFacture): self
    {
        $this->numFacture = $numFacture;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getValidation(): ?bool
    {
        return $this->validation;
    }

    public function setValidation(?bool $validation): self
    {
        $this->validation = $validation;

        return $this;
    }

    public function getIdFiche(): ?FicheFrais
    {
        return $this->idFiche;
    }

    public function setIdFiche(?FicheFrais $idFiche): self
    {
        $this->idFiche = $idFiche;

        return $this;
    }


}
