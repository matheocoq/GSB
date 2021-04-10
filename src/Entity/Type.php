<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="TYPE")
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_TYPE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="LIBELLE", type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @var float|null
     *
     * @ORM\Column(name="MONTANT", type="float", precision=10, scale=0, nullable=true)
     */
    private $montant;

    public function getIdType(): ?int
    {
        return $this->idType;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant;
    }

    public function setMontant(?float $montant): self
    {
        $this->montant = $montant;

        return $this;
    }


}
