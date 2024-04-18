<?php

namespace App\Form;

use App\Entity\HorraireZoo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorraireZooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('jour')
        ->add('heureOuverture')
        ->add('heureFermeture')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => HorraireZoo::class,
        ]);
    }
}
