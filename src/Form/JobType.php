<?php

namespace App\Form;

use App\Entity\Job;
use App\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class JobType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,
            [
                'label' => 'Job Title',
                'required' => true,
                'attr' => [
                    'minlength' => 3,
                    'maxlength' => 30
                ]
            ])
            ->add('company', TextType::class,
            [
                'label' => 'Company Name',
                'required' => true,
                'attr' => [
                    'minlength' => 5,
                    'maxlength' => 50
                ]
            ])
            ->add('position', TextType::class,
            [
                'label' => 'Job Position',
                'required' => true,
                'attr' => [
                    'minlength' => 4,
                    'maxlength' => 20
                ]
            ])
            ->add('salary', NumberType::class,
            [
                'label' => 'Job Salary',
                'required' => true
            ])
            ->add('people', EntityType::class,
            [
                'label' => 'Employee Name',
                'required' => true,
                'class' => Person::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('Save', SubmitType::class) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Job::class,
        ]);
    }
}
