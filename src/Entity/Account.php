<?php

// when working with associations, I used: https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/working-with-associations.html#working-with-associations
// and https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/association-mapping.html#association-mapping

namespace App\Entity;

use App\Repository\AccountRepository;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'accounts')]
    #[ORM\JoinColumn(nullable:false)]
    private ?Employee $employee = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?DateTimeImmutable $expiration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getExpiration(): ?DateTimeImmutable
    {
        return $this->expiration;
    }

    public function setExpiration(?DateTimeImmutable $expiration): static
    {
        $this->expiration = $expiration;

        return $this;
    }
}
