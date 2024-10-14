<?php

namespace App;

class StaticDatabase
{
    private array $employees = [];

    public function __construct()
    {
        $this->employees[1] = new Employee("Petr Novák", "petr.novak@priklad.cz", )
    }
    public function addEmployee(Employee $employee): void
    {
        $this->employees[] = $employee;
    }
    public function getEmployees(): array
    {
        return $this->employees;
    }
    public function getEmployeeById(int $id): ?Employee
    {
        foreach ($this->employees as $employee) {
            if ($employee->getID() === $id) {
                return $employee;
            }
        }
        return null;
    }
    public function removeEmployeeById(int $id): bool
    {
        foreach ($this->employees as $index => $employee) {
            if ($employee->getID() === $id) {
                unset($this->employees[$index]);
                $this->employees = array_values($this->employees);
                return true;
            }
        }
        return false;
    }
}