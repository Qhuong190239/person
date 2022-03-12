<?php

namespace App\Form;

use App\Entity\Publisher;
use App\Entity\Game;
use App\Entity\Genre;
use App\Form\GameDetailType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('publisher', EntityType::class,
            [
                'label' => 'Publisher',
                'required' => true,
                'class' => Publisher::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('genrecn', EntityType::class,
            [
                'label' => 'Genre',
                'required' => true,
                'class' => Genre::class,
                'choice_label' => 'name',
                'multiple' => true
            ])
            ->add('detail', GameDetailType::class)
            ->add('Save', SubmitType::class) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
