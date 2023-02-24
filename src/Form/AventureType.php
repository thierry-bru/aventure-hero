<?php

namespace App\Form;

use App\Entity\Aventure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AventureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('difficultee')
            ->add('introduction')
            ->add('conclusion')
            ->add('premiereEtape')
            ->add('personnages')
            ->add('etapeFinale')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Aventure::class,
        ]);
    }
}
