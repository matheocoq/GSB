<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etat
 *
 * @ORM\Table(name="ETAT")
 * @ORM\Entity(repositoryClass="App\Repository\EtatRepository")
 */
class Etat
{
    /**
     * @var int
     *
     * @ORM\Column(name="ID_ETAT", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEtat;

    /**
     * @var string
     *
     * @ORM\Column(name="ETAT_ACTUEL", type="string", length=0, nullable=false)
     */
    private $etatActuel;

    public function getIdEtat(): ?int
    {
        return $this->idEtat;
    }

    public function getEtatActuel(): ?string
    {
        return $this->etatActuel;
    }

    public function setEtatActuel(string $etatActuel): self
    {
        $this->etatActuel = $etatActuel;

        return $this;
    }


}
