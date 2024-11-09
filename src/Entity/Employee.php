<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Jméno musí být vyplněno.")]
    private ?string $name;

    #[ORM\Column(length: 255, unique: true)]
    #[Assert\NotBlank(message: "Email musí být vyplněn")]
    #[Assert\Email(message: "Prosím zadejte syntakticky validní emailovou adresu.")]
    private ?string $email;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image_url = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $office_location = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $phone;

    #[ORM\Column(type: 'array', nullable: true)]
    private ?array $role_ids = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getimage_url(): ?string
    {
        return $this->image_url;
    }

    public function setImageUrl(string $image_url): static
    {
        $this->image_url = $image_url;

        return $this;
    }

    public function getOfficeLocation(): ?string
    {
        return $this->office_location;
    }

    public function getoffice_location(): ?string
    {
        return $this->office_location;
    }

    public function setoffice_location(?string $office_location): static
    {
        $this->office_location = $office_location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getRoles(): ?array
    {
        return $this->role_ids;
    }

    public function getRoleIds(): ?array
    {
        return $this->role_ids;
    }

    public function setRoles(?array $role_ids): static
    {
        $this->role_ids = $role_ids;

        return $this;
    }

    public function setRoleIds(?array $role_ids): static
    {
        $this->role_ids = $role_ids;

        return $this;
    }

}
