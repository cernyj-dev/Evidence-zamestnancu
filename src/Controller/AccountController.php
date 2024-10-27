<?php

namespace App\Controller;

use App\Database\Database;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/account')]
class AccountController extends AbstractController
{
    public function __construct(private Database $database){}
    #[Route('/{id}', name: 'app_employee_account_details', requirements: ['id' => '\d+'])]
    public function accountDetails(int $id): Response
    {
        $employee = $this->database->getEmployeeById($id);

        if ($employee === null) {
            throw $this->createNotFoundException();
        }

        return $this->render('account/employee_account_details.html.twig', [
            'title' => "{$employee->name}'s detaily ůčtů",
            'employee' => $employee,
        ]);
    }
}
