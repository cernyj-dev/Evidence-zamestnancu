<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Employee;
use App\Form\AccountType;
use Doctrine\ORM\EntityManagerInterface;
use App\Operation\AccountOperation;
use App\Repository\AccountRepository;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employees')]
class AccountController extends AbstractController
{
    public function __construct(
        private AccountRepository $accountRepository,
        private EmployeeRepository $employeeRepository,
        private AccountOperation $accountOperation
    ){}
    #[Route('/{id}/accounts', name: 'app_employee_account_details', requirements: ['id' => '\d+'])]
    public function accountDetails(Employee $employee): Response
    {
        $employee_accounts = $this->accountRepository->findBy(array('employee_id' => $employee->getId()));
        return $this->render('account/employee_account_details.html.twig', [
            'title' => "{$employee->getName()}'s detaily ůčtů",
            'employee' => $employee,
            'accounts' => $employee_accounts,
        ]);
    }

    #[Route('/{employee_id}/create', name: 'app_account_create', requirements: ['employee_id' => '\d+'])]
    #[Route('/{employee_id}/{id}/edit', name: 'app_account_edit', requirements: ['employee_id' => '\d+', 'id' => '\d+'])]
    public function form(int $employee_id, ?Account $account, Request $request): Response
    {
        // Check whether or not the employee with this ID actually exists in the database
        $employee = $this->employeeRepository->find($employee_id);
        if (!$employee) {
            throw $this->createNotFoundException("Employee not found");
        }

        if (!$account) {
            $account = new Account();
            $account->setEmployeeId($employee_id);
        }

        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->accountOperation->store($form->getData());

            return $this->redirectToRoute('app_employee_account_details', ['id' => $employee_id]);
        }

        return $this->render('account/account_form.html.twig', [
            'title' => $account ? 'Upravování účtu' : 'Vytváření účtu',
            'form' => $form->createView(),
            'button_text' => $account ? 'Upravit' : 'Vytvořit'
        ]);
    }
}
