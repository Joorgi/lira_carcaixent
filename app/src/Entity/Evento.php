<?php

namespace App\Entity;

use App\Repository\EventoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventoRepository::class)]
class Evento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'NOMBRE', type: 'string', length: 50)]
    private $Nombre;

    #[ORM\Column(name: 'FECHA', type: 'datetime')]
    private $Fecha;

    #[ORM\Column(name: 'LUGAR', type: 'string', length: 50, nullable: true)]
    private $Lugar;

    #[ORM\Column(name: 'BANDA', type: 'string', length: 50)]
    private $Banda;

    #[ORM\Column(name: 'ID_PIEZA', type: 'integer')]
    private $idPieza;

    public function __toString()
    {
        return $this->Nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->Fecha;
    }

    public function setFecha(\DateTimeInterface $Fecha): self
    {
        $this->Fecha = $Fecha;

        return $this;
    }

    public function getLugar(): ?string
    {
        return $this->Lugar;
    }

    public function setLugar(?string $Lugar): self
    {
        $this->Lugar = $Lugar;

        return $this;
    }

    public function getBanda(): ?string
    {
        return $this->Banda;
    }

    public function setBanda(string $Banda): self
    {
        $this->Banda = $Banda;

        return $this;
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
}
