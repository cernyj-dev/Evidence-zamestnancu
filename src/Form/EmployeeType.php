<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Role;
use App\Repository\RoleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EmployeeType extends AbstractType
{
    private array $role_choices;
    public function __construct(RoleRepository $role_repository){
        $this->role_choices = $this->getRoleChoices($role_repository);
    }

    private function getRoleChoices(RoleRepository $roleRepository): array
    {
        $roles = $roleRepository->findAll();
        $choices = [];

        foreach ($roles as $role) {
            $choices[$role->getName()] = $role->getId();
        }

        return $choices;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Jméno a příjmení',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('office_location', TextType::class, [
                'label' => 'Kancelář',
                'required' => false,
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Popis',
                'required' => false,
            ])
            ->add('phone', TextType::class, [
                'label' => 'Telefon',
                'required' => true,
            ])

            ->add('role_ids', EntityType::class, [
                'class' => Role::class,
                'multiple' => true,
                'expanded' => true,
                'label' => 'Výběr rolí',
                'required' => false,
                'choice_label' => 'title',
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
