<?php

namespace App\Entity;

use App\Repository\PiezaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PiezaRepository::class)]
class Pieza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'NOMBRE', type: 'string', length: 50)]
    private $Nombre;

    #[ORM\ManyToOne(targetEntity:Autor::class)]
    #[ORM\JoinColumn(name: 'ID_AUTOR', referencedColumnName: 'ID', nullable: false)]
    private $idAutor;

    #[ORM\Column(name: 'ID_EVENTO', type: 'integer')]
    private $idEvento;

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

    public function getIdAutor(): ?Autor
    {
        return $this->idAutor;
    }

    public function setIdAutor(?Autor $idAutor): self
    {
        $this->idAutor = $idAutor;

        return $this;
    }

    public function getIdEvento(): ?int
    {
        return $this->idEvento;
    }

    public function setIdEvento(int $idEvento): self
    {
        $this->idEvento = $idEvento;

        return $this;
    }
}
