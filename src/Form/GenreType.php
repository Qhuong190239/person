<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GenreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('tag', ChoiceType::class,
        // [
        //     'label' => 'Tag Name',
        //     'required' => true,
        //     'choices' => [
        //         'Horror' => 'Horror',
        //         'Romance' => 'Romance',
        //         'Action' => 'Action',
        //         'Adventure' => 'Adventure',
        //         'Rhythm' => 'Rhythm',
        //         'Survival' => 'Survival',
        //         'Shooter' => 'Shooter',
        //         'Puzzle' => 'Puzzle'
        //     ]
        // ])
        ->add('name', TextType::class, 
        [
            'label' => 'Genre Name',
            'required' => true,
            'attr' => [
                'minlength' => 2,
                'maxlength' => 30
            ]
        ])
            ->add('description', TextType::class, 
            [
                'label' => 'Genre Description',
                'required' => true,
                'attr' => [
                    'minlength' => 2,
                    'maxlength' => 30
                ]
            ])
            ->add('Save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Genre::class,
        ]);
    }
}
