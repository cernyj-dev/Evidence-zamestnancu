<?php
declare(strict_types=1);

namespace App\Operation;

use App\Entity\Role;
use Doctrine\ORM\EntityManagerInterface;

class RoleOperation
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    public function store(Role $role): int
    {
        $this->manager->persist($role);
        $this->manager->flush();

        return $role->getId();
    }

    public function remove(Role $role): int
    {
        $this->manager->remove($role);
        $this->manager->flush();

        return $role->getId();
    }
}