<?php

namespace App\Form;

use App\Entity\GameUserCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddCaracType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('power')
            ->add('defense')
            ->add('magic')
            ->add('luck')
            ->add('speed')
            ->add('concentration')
            ->add('life')
            ->add('energy')
            ->add('points_to_distribute', IntegerType::class, [
                'attr' => [
                    'disabled' => 'disabled'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameUserCharacter::class,
            'csrf_protection' => false,
        ]);
    }
}
