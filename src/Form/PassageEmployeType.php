<?php

namespace App\Form;

use App\Entity\PassageEmploye;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PassageEmployeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nourriture_apportee')
            ->add('Grammage_de_la_nourriture')
            ->add('Date_de_passage')
            ->add('Heure_de_passage')
            ->add('animal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PassageEmploye::class,
        ]);
    }
}
