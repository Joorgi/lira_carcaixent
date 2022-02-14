<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'NOMBRE', type: 'string', length: 50)]
    private $nombre;

    #[ORM\Column(name: 'PRIMER_APELLIDO', type: 'string', length: 50)]
    private $primerApellido;

    #[ORM\Column(name: 'SEGUNDO_APELLIDO', type: 'string', length: 50, nullable: true)]
    private $segundoApellido;

    #[ORM\Column(name: 'DNI', type: 'string', length: 9)]
    private $DNI;

    #[ORM\Column(name: 'FECHA_ALTA', type: 'datetime', nullable: true)]
    private $fechaAlta;

    #[ORM\Column(name: 'FECHA_BAJA', type: 'datetime', nullable: true)]
    private $fechaBaja;

    #[ORM\Column(name: 'TIPO', type: 'string', length: 50)]
    private $Tipo;

    public function __toString()
    {
        return $this->nombre;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getPrimerApellido(): ?string
    {
        return $this->primerApellido;
    }

    public function setPrimerApellido(string $primerApellido): self
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    public function getSegundoApellido(): ?string
    {
        return $this->segundoApellido;
    }

    public function setSegundoApellido(?string $segundoApellido): self
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    public function getDNI(): ?string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): self
    {
        $this->DNI = $DNI;

        return $this;
    }

    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fechaAlta;
    }

    public function setFechaAlta(?\DateTimeInterface $fechaAlta): self
    {
        $this->fechaAlta = $fechaAlta;

        return $this;
    }

    public function getFechaBaja(): ?\DateTimeInterface
    {
        return $this->fechaBaja;
    }

    public function setFechaBaja(?\DateTimeInterface $fechaBaja): self
    {
        $this->fechaBaja = $fechaBaja;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->Tipo;
    }

    public function setTipo(string $Tipo): self
    {
        $this->Tipo = $Tipo;

        return $this;
    }
}
