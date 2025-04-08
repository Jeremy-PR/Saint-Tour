<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\IsTrue;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'attr' => [
                'id' => 'email',
                'required' => true,
            ],
            'label' => 'Email',
        ])
        ->add('pseudo', TextType::class, [
            'attr' => [
                'id' => 'pseudo',
                'required' => true,
            ],
            'label' => 'Pseudo',
        ])
        ->add('plainPassword', RepeatedType::class, [
            'mapped' => false,
            'attr' => ['autocomplete' => 'new-password'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Your password should be at least {{ limit }} characters',
                ]),
            ],
            'type' => PasswordType::class,
            'first_options' => ['label' => 'Mot de passe'],
            'second_options' => ['label' => 'Répétez le mot de passe'],
            'invalid_message' => 'Les mots de passe ne correspondent pas.',
        ])
        // Case obligatoire pour accepter les CGU et la politique de confidentialité
        ->add('agreeTerms', CheckboxType::class, [
            'mapped' => false,
            'constraints' => [
                new IsTrue([
                    'message' => 'Vous devez accepter les conditions générales d\'utilisation et la politique de confidentialité.',
                ]),
            ],
            'label' => 'J\'accepte les conditions générales d\'utilisation et la politique de confidentialité',
        ])
        // Case optionnelle pour les offres promotionnelles
        ->add('receivePromotions', CheckboxType::class, [
            'mapped' => true,
            'required' => false,
            'label' => 'Recevoir des offres promotionnelles et des informations marketing',
            ]);
    
        }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
