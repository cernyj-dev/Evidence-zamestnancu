<?php

namespace App\Controller;

use App\Entity\Employee;

use App\Repository\AccountRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/account')]
class AccountController extends AbstractController
{
    public function __construct(
        private AccountRepository $accountRepository
    ){}
    #[Route('/{id}', name: 'app_employee_account_details', requirements: ['id' => '\d+'])]
    public function accountDetails(Employee $employee): Response
    {
        $employee_accounts = $this->accountRepository->findBy(array('employee_id' => $employee->getId()));
        return $this->render('account/employee_account_details.html.twig', [
            'title' => "{$employee->getName()}'s detaily ůčtů",
            'employee' => $employee,
            'accounts' => $employee_accounts,
        ]);
    }
}
