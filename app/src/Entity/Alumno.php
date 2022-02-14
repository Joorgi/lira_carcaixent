<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumnoRepository::class)]
class Alumno
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'NOMBRE', type: 'string', length: 50)]
    private $Nombre;

    #[ORM\Column(name: 'PRIMER_APELLIDO', type: 'string', length: 50)]
    private $primerApellido;

    #[ORM\Column(name: 'SEGUNDO_APELLIDO', type: 'string', length: 50, nullable: true)]
    private $segundoApellido;

    #[ORM\Column(name: 'FECHA_ALTA', type: 'datetime', nullable: true)]
    private $fechaAlta;

    #[ORM\Column(name: 'FECHA_BAJA', type: 'datetime', nullable: true)]
    private $fechaBaja;

    #[ORM\ManyToOne(targetEntity: Socio::class)]
    #[ORM\JoinColumn(name: 'ID_SOCIO', referencedColumnName: 'ID', nullable: true)]
    private $idSocio;

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

    public function getIdSocio(): ?Socio
    {
        return $this->idSocio;
    }

    public function setIdSocio(?Socio $idSocio): self
    {
        $this->idSocio = $idSocio;

        return $this;
    }
}
