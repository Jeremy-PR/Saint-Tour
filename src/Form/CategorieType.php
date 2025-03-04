<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Itineraire;
use App\Entity\Lieu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('lieux', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('itineraires', EntityType::class, [
                'class' => Itineraire::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
