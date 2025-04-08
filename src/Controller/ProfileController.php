<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\FormError;

#[Route('/profile')]
#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit')]
    public function edit(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        /** @var \App\Entity\User $user */
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        // Création du formulaire
        $form = $this->createFormBuilder($user)
            ->add('pseudo', TextType::class, ['label' => 'Pseudo'])
            ->add('email', TextType::class, ['label' => 'Email'])
            ->add('currentPassword', PasswordType::class, [
                'label' => 'Mot de passe actuel',
                'mapped' => false, // Ce champ ne sera pas directement lié à l'entité User
            ])
            ->add('newPassword', PasswordType::class, [
                'label' => 'Nouveau mot de passe',
                'required' => false, // Le champ n'est pas obligatoire
                'mapped' => false, // Ce champ ne sera pas directement lié à l'entité User
            ])
            ->add('confirmPassword', PasswordType::class, [
                'label' => 'Confirmer le nouveau mot de passe',
                'required' => false, // Le champ n'est pas obligatoire
                'mapped' => false, // Ce champ ne sera pas directement lié à l'entité User
            ])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $currentPassword = $form->get('currentPassword')->getData();
            $newPassword = $form->get('newPassword')->getData();
            $confirmPassword = $form->get('confirmPassword')->getData();

            // Vérification du mot de passe actuel
            if (!$passwordHasher->isPasswordValid($user, $currentPassword)) {
                $form->get('currentPassword')->addError(new FormError('Le mot de passe actuel est incorrect.'));
            } else {
                // Si un nouveau mot de passe a été fourni, on le met à jour
                if ($newPassword && $newPassword === $confirmPassword) {
                    $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($hashedPassword);
                } elseif ($newPassword !== $confirmPassword) {
                    $form->get('confirmPassword')->addError(new FormError('Les mots de passe ne correspondent pas.'));
                }

                // Sauvegarde des modifications (pseudo, email, etc.)
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Profil mis à jour avec succès !');

                return $this->redirectToRoute('app_profile');
            }
        }

        return $this->render('profile/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/delete', name: 'app_profile_delete')]
    public function delete(EntityManagerInterface $em): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        // Supprimez l'utilisateur
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Votre compte a été supprimé avec succès.');

        return $this->redirectToRoute('app_home');
    }
}
