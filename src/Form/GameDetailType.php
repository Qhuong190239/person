<?php

namespace App\Form;

use App\Entity\GameDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GameDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('platform', ChoiceType::class,
            [
                'choices' => [
                    'Windows' => 'Windows',
                    'Mac' => 'Mac',
                    'Linux' => 'Linux',
                    'PSP' => 'PSP'
                ]
            ])
            ->add('price', MoneyType::class,
            [
                'label' => 'Game Price',
                'currency' => 'USD'
            ])
            ->add('birthday', DateType::class,
            [
                'label' => 'Release Date',
                'widget' => 'single_text'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GameDetail::class,
        ]);
    }
}
