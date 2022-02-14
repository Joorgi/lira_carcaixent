<?php

namespace App\Entity;

use App\Repository\PartituraRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PartituraRepository::class)]
class Partitura
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'ID_PIEZA', type: 'integer')]
    private $idPieza;

    #[ORM\ManyToOne(targetEntity:Instrumento::class)]
    #[ORM\JoinColumn(name: 'ID_INSTRUMENTO', referencedColumnName: 'ID', nullable: false)]
    private $idInstrumento;

    #[ORM\Column(name: 'ROL_INSTRUMENTO', type: 'string', length: 50)]
    private $rolInstrumento;

    #[ORM\Column(name: 'FICHERO', type: 'string', length: 255)]
    private $fichero;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPieza(): ?int
    {
        return $this->idPieza;
    }

    public function setIdPieza(int $idPieza): self
    {
        $this->idPieza = $idPieza;

        return $this;
    }

    public function getIdInstrumento(): ?Instrumento
    {
        return $this->idInstrumento;
    }

    public function setIdInstrumento(?Instrumento $idInstrumento): self
    {
        $this->idInstrumento = $idInstrumento;

        return $this;
    }

    public function getRolInstrumento(): ?string
    {
        return $this->rolInstrumento;
    }

    public function setRolInstrumento(string $rolInstrumento): self
    {
        $this->rolInstrumento = $rolInstrumento;

        return $this;
    }

    public function getFichero(): ?string
    {
        return $this->fichero;
    }

    public function setFichero(string $fichero): self
    {
        $this->fichero = $fichero;

        return $this;
    }
}
