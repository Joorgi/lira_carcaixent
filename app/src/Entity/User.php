<?php

namespace App\Entity;

use App\Entity\Musico;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'ID', type: 'integer')]
    private $id;

    #[ORM\Column(name: 'EMAIL', type: 'string', length: 180, unique: true)]
    private $email;

    #[ORM\Column(name: 'ROLES', type: 'json')]
    private $roles = [];

    #[ORM\Column(name: 'PASSWORD', type: 'string')]
    private $password;

    #[ORM\OneToOne(targetEntity: Musico::class)]
    #[ORM\JoinColumn(name: 'ID_MUSICO', referencedColumnName: 'ID')]
    private $idMusico;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getIdMusico(): ?Musico
    {
        return $this->idMusico;
    }

    public function setIdMusico(?Musico $idMusico): self
    {
        $this->idMusico = $idMusico;

        return $this;
    }
}
