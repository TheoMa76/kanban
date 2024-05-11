<?php

namespace App\Form;

use App\Entity\Board;
use App\Entity\Step;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StepType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('position')
            ->add('board', EntityType::class, [
                'class' => Board::class,
                'choice_label' => 'id',
                'multiple' => false,
            ])
            // ->add('created_at', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('updated_at', null, [
            //     'widget' => 'single_text',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Step::class,
        ]);
    }
}
