<?php

namespace App\Form;

use App\Entity\Job;
use App\Form\JobType;
use App\Entity\Person;
use App\Form\PersonDetailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('job', EntityType::class,
            [
                'label' => 'Job Title',
                'required' => true,
                'class' => Job::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('detail', PersonDetailType::class)
            ->add('Save', SubmitType::class) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
