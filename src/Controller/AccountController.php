<?php

namespace App\Controller;

use App\Entity\Account;
use App\Entity\Employee;
use App\Form\AccountType;
use App\Form\RemoveType;
use Doctrine\ORM\EntityManagerInterface;
use App\Operation\AccountOperation;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/employees')]
class AccountController extends AbstractController
{
    public function __construct(
        private AccountOperation $accountOperation
    ){}
    #[Route('/{id}/accounts', name: 'app_employee_account_details', requirements: ['id' => '\d+'])]
    public function accountDetails(Employee $employee): Response
    {
        return $this->render('account/employee_account_details.html.twig', [
            'title' => "{$employee->getName()}'s detaily ůčtů",
            'employee' => $employee,
        ]);
    }

    #[Route('/{employee_id}/create', name: 'app_account_create', requirements: ['employee_id' => '\d+'])]
    #[Route('/{employee_id}/{id}/edit', name: 'app_account_edit', requirements: ['employee_id' => '\d+', 'id' => '\d+'])]
    public function form(#[MapEntity(id: 'employee_id')] Employee $employee, ?Account $account, Request $request): Response
        // potential error between employee_id and $employee mapping - hopefully it will - used this as inspiration: https://symfony.com/doc/current/routing.html
        // https://symfony.com/doc/current/doctrine.html#doctrine-entity-value-resolver
    {

        $form = $this->createForm(AccountType::class, $account);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($account) {
                $id = $this->accountOperation->store($form->getData());
            }
            else{
                $id = $this->accountOperation->store($form->getData(), $employee);
            }

            return $this->redirectToRoute('app_employee_account_details', ['id' => $employee->getId()]);
        }

        return $this->render('account/account_form.html.twig', [
            'title' => $account ? 'Upravování účtu' : 'Vytváření účtu',
            'form' => $form,
            'button_text' => $account ? 'Upravit' : 'Vytvořit'
        ]);
    }
    #[Route('/{employee_id}/accounts/{id}/remove', name: 'app_account_remove', requirements: ['employee_id' => '\d+', 'id' => '\d+'])]
    public function remove(#[MapEntity(id: 'employee_id')] Employee $employee, Account $account, Request $request, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(RemoveType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->accountOperation->remove($account);

            return $this->redirectToRoute('app_employee_account_details', ['id' => $employee->getId()]);
        }

        return $this->render('account/account_remove_form.html.twig', [
            'title' => 'Odstranit účet',
            'account' => $account,
            'form' => $form,
        ]);
    }

}
