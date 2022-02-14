<?php

namespace App\Entity;

use App\Repository\MusicoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicoRepository::class)]
class Musico
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity:Alumno::class)]
    #[ORM\JoinColumn(name: 'ID_ALUMNO', referencedColumnName: 'ID', nullable: false)]
    private $idAlumno;

    #[ORM\Column(name: 'ID_SOCIO', type: 'integer', nullable: true)]
    private $idSocio;

    #[ORM\Column(name: 'NOMBRE', type: 'string', length: 50)]
    private $Nombre;

    #[ORM\Column(name: 'PRIMER_APELLIDO', type: 'string', length: 50)]
    private $primerApellido;

    #[ORM\Column(name: 'SEGUNDO_APELLIDO', type: 'string', length: 50)]
    private $segundoApellido;

    #[ORM\Column(name: 'DNI', type: 'string', length: 9)]
    private $DNI;

    #[ORM\Column(name: 'ID_INSTRUMENTO', type: 'integer', nullable: true)]
    private $idInstrumento;

    #[ORM\Column(name: 'ID_BANDA', type: 'integer')]
    private $idBanda;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdAlumno(): ?Alumno
    {
        return $this->idAlumno;
    }

    public function setIdAlumno(?Alumno $idAlumno): self
    {
        $this->idAlumno = $idAlumno;

        return $this;
    }

    public function getIdSocio(): ?int
    {
        return $this->idSocio;
    }

    public function setIdSocio(?int $idSocio): self
    {
        $this->idSocio = $idSocio;

        return $this;
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

    public function setSegundoApellido(string $segundoApellido): self
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

    public function getIdInstrumento(): ?int
    {
        return $this->idInstrumento;
    }

    public function setIdInstrumento(?int $idInstrumento): self
    {
        $this->idInstrumento = $idInstrumento;

        return $this;
    }

    public function getIdBanda(): ?int
    {
        return $this->idBanda;
    }

    public function setIdBanda(int $idBanda): self
    {
        $this->idBanda = $idBanda;

        return $this;
    }
}
