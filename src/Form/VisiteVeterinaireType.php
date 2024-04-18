<?php

namespace App\Form;

use App\Entity\VisiteVeterinaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class VisiteVeterinaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etat_animal')
            ->add('nourriture_proposee')
            ->add('grammage_nourriture')
            ->add('date_passage', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd', // Ajustez le format selon vos besoins
            ])
            ->add('detail_etat_animal')
            ->add('Nom_veterinaire')
            ->add('animal')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VisiteVeterinaire::class,
        ]);
    }
}
