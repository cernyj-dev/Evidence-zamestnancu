<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RoleRepository;
use App\Operation\RoleOperation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/roles')]
class RoleController extends AbstractController
{
    public function __construct(
        private RoleRepository $roleRepository,
        private RoleOperation $roleOperation
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
    #[Route('/create', name: 'app_role_create')]
    #[Route('/{id}/edit', name: 'app_role_edit', requirements: ['id' => '\d+'])]
    public function form(?Role $role, Request $request): Response
    {
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $this->roleOperation->store($form->getData());

            return $this->redirectToRoute('app_employee_roles');
        }

        return $this->render('roles/role_form.html.twig', [
            'title' => $role ? 'Upravit roli' : 'Nová role',
            'form' => $form->createView(),
            'button_text' => $role ? 'Upravit' : 'Vytvořit'
        ]);
    }
}
