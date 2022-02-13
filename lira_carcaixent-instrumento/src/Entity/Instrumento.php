<?php

namespace App\Entity;

use App\Repository\InstrumentoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstrumentoRepository::class)]
class Instrumento
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID',type: 'integer')]
    private $id;

    #[ORM\Column(name: 'NOMBRE_INSTRUMENTO', type: 'string', length: 50)]
    private $Nombre;

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
}
