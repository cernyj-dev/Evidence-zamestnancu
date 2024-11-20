<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Operation\EmployeeOperation;

class EmployeeController extends AbstractController
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private RoleRepository $roleRepository,
        private EmployeeOperation $employeeOperation
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
        $rolesById = $this->roleRepository->findAllReindexedById();

        return $this->render('employee/employees.html.twig', [
            'title' => 'Seznam zaměstnanců',
            'employees' => $this->employeeRepository->findAll(),
            'all_roles' => $rolesById,
        ]);
    }

    #[Route('/employees/{id}', name: 'app_employee_details', requirements: ['id' => '\d+'])]
    public function show(Employee $employee): Response
    {
        $rolesById = $this->roleRepository->findAllReindexedById();

        return $this->render('employee/employee_details.html.twig', [
            'title' => "Detail: {$employee->getName()}",
            'employee' => $employee,
            'all_roles' => $rolesById,

        ]);
    }

    #[Route('/employees/create', name: 'app_employee_create')]
    #[Route('/employees/{id}/edit', name: 'app_employee_edit', requirements: ['id' => '\d+'])]
    public function form(?Employee $employee, Request $request): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);



        if($form->isSubmitted() && $form->isValid()){
            $id = $this->employeeOperation->store($form->getData());

            return $this->redirectToRoute('app_employee_details', ['id' => $id]);
        }

        return $this->render('employee/employee_form.html.twig', [
            'title' => $employee ? 'Upravení zaměstnance' : 'Vytvoření zaměstnance',
            'form' => $form,
            'button_text' => $employee ? 'Upravit' : 'Vytvořit'
        ]);


    }


}
