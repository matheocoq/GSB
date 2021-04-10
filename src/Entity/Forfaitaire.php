<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Forfaitaire
 *
 * @ORM\Table(name="FORFAITAIRE", indexes={@ORM\Index(name="I_FK_FORFAITAIRE_FICHE_FRAIS", columns={"ID_FICHE"}), @ORM\Index(name="I_FK_FORFAITAIRE_TYPE", columns={"ID_TYPE"})})
 * @ORM\Entity(repositoryClass="App\Repository\ForfaitaireRepository")
 */
class Forfaitaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_FRAIS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFrais;

    /**
     * @var int
     *
     * @ORM\Column(name="QTE", type="integer", nullable=false)
     */
    private $qte;

    /**
     * @var \FicheFrais
     *
     * @ORM\ManyToOne(targetEntity="FicheFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_FICHE", referencedColumnName="ID_FICHE")
     * })
     */
    private $idFiche;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ID_TYPE", referencedColumnName="ID_TYPE")
     * })
     */
    private $idType;

    public function getIdFrais(): ?int
    {
        return $this->idFrais;
    }

    public function getQte(): ?int
    {
        return $this->qte;
    }

    public function setQte(int $qte): self
    {
        $this->qte = $qte;

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

    public function getIdType(): ?Type
    {
        return $this->idType;
    }

    public function setIdType(?Type $idType): self
    {
        $this->idType = $idType;

        return $this;
    }


}
