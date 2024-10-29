<?php

namespace App\Controller;

use App\Database\Database;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmployeeController extends AbstractController
{
    public function __construct(private Database $database){}
    #[Route('/', name: 'app_homepage')]
    public function titlePage(): Response
    {
        return $this->render('employee/title_page.html.twig', [
            'title' => 'Titulní stránka',
            'newbies' => $this->database->getNewestEmployees(12),
        ]);
    }

    #[Route('/employees', name: 'app_employees')]
    public function index(): Response
    {
        return $this->render('employee/employees.html.twig', [
            'title' => 'Seznam zaměstnanců',
            'employees' => $this->database->getEmployees(),
            'all_roles' => $this->database->getRoles(),
        ]);
    }

    #[Route('/employee/{id}', name: 'app_employee_details', requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $employee = $this->database->getEmployeeById($id);

        if ($employee === null) {
            throw $this->createNotFoundException();
        }

        return $this->render('employee/employee_details.html.twig', [
            'title' => "Detail: {$employee->getName()}",
            'employee' => $employee,
            'all_roles' => $this->database->getRoles(),

        ]);
    }


}
