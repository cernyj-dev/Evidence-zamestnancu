<?php
declare(strict_types=1);

// when working with associations, I used: https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/working-with-associations.html#working-with-associations
// and https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/association-mapping.html#association-mapping

namespace App\Operation;

use App\Entity\Account;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class AccountOperation
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    public function store(Account $account, ?Employee $employee = null): int
    {
        if($employee){
            $employee->addAccount($account);
            $this->manager->persist($employee);
        }

        $this->manager->persist($account);
        $this->manager->flush();

        return $account->getId();
    }

    public function remove(Account $account): Account
    {
        $employee = $account->getEmployee();
        if($employee){
            $employee->removeAccount($account);
            $this->manager->persist($employee);
        }

        $this->manager->remove($account);
        $this->manager->flush();

        return $account;
    }
}