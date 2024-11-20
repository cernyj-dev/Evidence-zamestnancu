<?php

// used this for redirecting from title page: https://symfony.com/doc/current/controller.html#controller-redirect
// when it comes to filters, I drew only from the source code of my teacher
//      from: https://gitlab.fit.cvut.cz/BI-TWA/B241/tutorial/-/commit/737efcb3eaae65b673d011ad586c04cd22ef2377

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use App\Form\EmployeeFilterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Operation\EmployeeOperation;

class EmployeeController extends AbstractController
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private EmployeeOperation $employeeOperation
    ){}
    #[Route('/', name: 'app_homepage')]
    public function titlePage(Request $request): Response
    {
        $form = $this->createForm(EmployeeFilterType::class, options:[
            'method' => 'GET',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('app_employees', $request->query->all());
        }

        return $this->render('employee/title_page.html.twig', [
            'title' => 'Titulní stránka',
            'filter' => $form,
            'employees' => $this->employeeRepository->findBy([], ['id' => 'DESC'])
        ]);
    }

    #[Route('/employees', name: 'app_employees')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(EmployeeFilterType::class, options:[
           'method' => 'GET',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $employees = $this->employeeRepository->findByFilter($form->getData());
        }
        else{
            $employees = $this->employeeRepository->findAll();
        }

        return $this->render('employee/employees.html.twig', [
            'title' => 'Seznam zaměstnanců',
            'employees' => $employees,
            'filter' => $form,
        ]);
    }

    #[Route('/employees/{id}', name: 'app_employee_details', requirements: ['id' => '\d+'])]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/employee_details.html.twig', [
            'title' => "Detail: {$employee->getName()}",
            'employee' => $employee,
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
