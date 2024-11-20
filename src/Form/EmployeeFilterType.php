<?php
// drew from: https://gitlab.fit.cvut.cz/BI-TWA/B241/tutorial/-/commit/737efcb3eaae65b673d011ad586c04cd22ef2377

namespace App\Form;

use App\Controller\Filter\EmployeeFilter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void{
        $builder
            ->add('name', TextType::class, [
                'label' => 'Jméno a příjmení: ',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EmployeeFilter::class,
        ]);
    }
}