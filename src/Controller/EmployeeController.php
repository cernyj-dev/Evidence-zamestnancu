<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Role;
use App\Repository\EmployeeRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private RoleRepository $roleRepository
    ){}
    #[Route('/', name: 'app_homepage')]
    public function titlePage(): Response
    {
        return $this->render('employee/title_page.html.twig', [
            'title' => 'Titulní stránka',
            'employees' => $this->employeeRepository->findBy([], ['id' => 'DESC'])
        ]);
    }

    #[Route('/employees', name: 'app_employees')]
    public function index(): Response
    {
        $allRoles = $this->roleRepository->findAll();
        $rolesById = [];

        // reindexing the roles, because from findAll, there were returned as an array index from 0
        // but Employee has them listed starting from 1
        foreach ($allRoles as $role) {
            $rolesById[$role->getId()] = $role;
        }

        return $this->render('employee/employees.html.twig', [
            'title' => 'Seznam zaměstnanců',
            'employees' => $this->employeeRepository->findAll(),
            'all_roles' => $rolesById,
        ]);
    }

    #[Route('/employee/{id}', name: 'app_employee_details', requirements: ['id' => '\d+'])]
    public function show(Employee $employee): Response
    {
        $allRoles = $this->roleRepository->findAll();
        $rolesById = [];

        foreach ($allRoles as $role) {
            $rolesById[$role->getId()] = $role;
        }

        return $this->render('employee/employee_details.html.twig', [
            'title' => "Detail: {$employee->getName()}",
            'employee' => $employee,
            'all_roles' => $rolesById,

        ]);
    }


}
