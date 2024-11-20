<?php
declare(strict_types=1);

// when working with associations, I used: https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/working-with-associations.html#working-with-associations
// and https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/association-mapping.html#association-mapping

namespace App\Operation;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeOperation
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    public function store(Employee $employee): int
    {
        $this->manager->persist($employee);
        $this->manager->flush();

        return $employee->getId();
    }

    public function remove(Employee $employee): Employee
    {
        foreach($employee->getAccounts() as $account){
            $this->manager->remove($account);
        }

        $this->manager->persist($employee);

        $this->manager->remove($employee);
        $this->manager->flush();

        return $employee;
    }
}