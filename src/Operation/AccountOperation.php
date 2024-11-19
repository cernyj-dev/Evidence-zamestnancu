<?php
declare(strict_types=1);

namespace App\Operation;

use App\Entity\Account;
use Doctrine\ORM\EntityManagerInterface;

class AccountOperation
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    public function store(Account $account): int
    {
        $this->manager->persist($account);
        $this->manager->flush();

        return $account->getId();
    }

    public function remove(Account $account): Account
    {
        $this->manager->remove($account);
        $this->manager->flush();

        return $account;
    }
}