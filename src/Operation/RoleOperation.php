<?php
declare(strict_types=1);

// when working with associations, I used: https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/working-with-associations.html#working-with-associations
// and https://www.doctrine-project.org/projects/doctrine-orm/en/stable/reference/association-mapping.html#association-mapping

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

    public function remove(Role $role): Role
    {
        $this->manager->remove($role);
        $this->manager->flush();

        return $role;
    }
}