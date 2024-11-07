<?php

namespace App\Controller;

use App\Entity\Employee;

use App\Repository\RoleRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/roles')]
class RoleController extends AbstractController
{
    public function __construct(
        private RoleRepository $roleRepository
    ){}
    #[Route('/', name: 'app_employee_roles')]
    public function roleDisplay(): Response
    {
        $all_roles = $this->roleRepository->findAll();
        return $this->render('roles/roles.html.twig', [
            'title' => "Všechny role",
            'all_roles' => $all_roles,
        ]);
    }
}
