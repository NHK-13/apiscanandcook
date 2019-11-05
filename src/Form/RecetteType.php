<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreRecette')
            ->add('slugRecette')
            ->add('descriptionRecette')
            ->add('ingredientsRecette')
            ->add('intructionRecette')
            ->add('nbDePersonne')
            ->add('timeCuisson')
            ->add('photo')
            ->add('typeRecette')
            ->add('timeRecette')
            ->add('regions')
            ->add('allergeneRecettes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
