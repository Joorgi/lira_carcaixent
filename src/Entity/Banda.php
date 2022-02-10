<?php

namespace App\Entity;

use App\Repository\BandaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BandaRepository::class)]
class Banda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
