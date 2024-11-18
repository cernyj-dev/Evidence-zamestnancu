<?php

namespace App\Entity;

use App\Repository\RoleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoleRepository::class)]
class Role
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;


    /**
     * Bidirectional - Many Roles are assigned to Many Employees. (INVERSE SIDE)
     * @var Collection<int, Employee>
     */
    #[ORM\ManyToMany(targetEntity: Employee::class, mappedBy: 'roles')]
    private Collection $employees;

    public function __construct(){
        $this->employees = new ArrayCollection();
    }

    public function getEmployees(): Collection{
        return $this->employees;
    }

    public function addEmployee(Employee $employee): static{
        // because this side is the inverse one, Im simply adding an employee into the collection via the add and not calling the addRole employee, because it would get into an infinite loop
        $this->employees->add($employee);

        return $this;
    }

    public function removeEmployee(Employee $employee): static{
        $this->employees->removeElement($employee);

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
}
