<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Itineraire;
use App\Entity\Lieu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItineraireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('lieux', CollectionType::class, [
                'entry_type' => LieuType::class,  // Assure-toi que LieuType existe
                'allow_add' => true,  // Pour permettre l'ajout de nouveaux lieux
                'allow_delete' => true,  // Pour permettre la suppression
                'by_reference' => false,  // Important pour que la relation soit gérée correctement
            ]);
            
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Itineraire::class,
        ]);
    }
}
