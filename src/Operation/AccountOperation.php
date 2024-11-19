<?php
declare(strict_types=1);

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