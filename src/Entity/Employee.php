<?php

// when working with associations, I used: https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/working-with-associations.html#working-with-associations
// and https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/association-mapping.html#association-mapping

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * Bidirectional - Many Employees have Many Roles. (OWNING SIDE)
     * @var Collection<int, Role>
     */
    #[ORM\ManyToMany(targetEntity: Role::class, inversedBy: 'employees')]
    #[ORM\JoinTable(name: 'employees_roles')]
    private Collection $roles;

    /**
     * Bidirectional - One Employee can have many Accounts (INVERSE SIDE)
     * @var Collection<int, Account>
     */
    #[ORM\OneToMany(targetEntity: Account::class, mappedBy: 'employee')]
    private Collection $accounts;

    public function __construct(){
        $this->roles = new ArrayCollection();
        $this->accounts = new ArrayCollection();
    }

    public function getRoles(): Collection
    {
        return $this->roles;
    }

    public function addRole(Role $role): static
    {
        if (!$this->roles->contains($role)) {
            $this->roles->add($role);
            $role->addEmployee($this);
        }
        return $this;
    }

    public function removeRole(Role $role): static
    {
        if($this->roles->removeElement($role)){
            if($role->getEmployees()->contains($this)) {
                $role->removeEmployee($this);
            }
        }
        return $this;
    }

    public function getAccounts(): Collection{
        return $this->accounts;
    }

    public function addAccount(Account $account): static{
        if(!$this->accounts->contains($account)){
            $this->accounts->add($account);
            $account->setEmployee($this);
        }
        return $this;
    }

    public function removeAccount(Account $account): static{
        if($this->accounts->removeElement($account)){
            if($account->getEmployee() === $this) {
                $account->setEmployee(null);
            }
        }
        return $this;
    }

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
}
