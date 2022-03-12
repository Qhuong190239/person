<?php

namespace App\Form;

use App\Entity\PersonDetail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
<<<<<<< HEAD
=======
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
>>>>>>> d0b3d43489e35b3beb64207560b37cc71100fdea

class PersonDetailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', NumberType::class,
            [
                'label' => 'Person ID',
                'required' => true
            ])
            ->add('nationality', ChoiceType::class,
            [
                'label' => 'Person Nationality',
                'choices' => [
                    'Vietnam' => 'Vietnam',
                    'Thailand' => 'ThaiLand',
                    'Singapore' => 'Singapore',
                    'China' => 'China'
                ]
            ])
            ->add('address', TextType::class,
            [
                'label' => 'Person Address',
                'required' => true
            ])
            ->add('mobile', NumberType::class,
            [
                'label' => 'Mobile Number',
                'required' => true
            ])
            ->add('birthday', DateType::class,
            [
                'widget' => 'single_text'
            ])
            //->add("Submit", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PersonDetail::class,
        ]);
    }
}
