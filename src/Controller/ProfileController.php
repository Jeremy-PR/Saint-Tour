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
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


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
        ->add('password', PasswordType::class, [
            'label' => 'Nouveau mot de passe',
            'required' => false, // Le champ n'est pas obligatoire
            'mapped' => false, // Ce champ ne sera pas directement lié à l'entité User
        ])
        ->add('save', SubmitType::class, ['label' => 'Enregistrer'])
        ->getForm();

    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // Vérifiez si un mot de passe a été saisi
        $plainPassword = $form->get('password')->getData();
        if ($plainPassword) {
            // Hachez le mot de passe et mettez-le à jour
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);
        }

        // Sauvegardez les modifications (pseudo, email, etc.)
        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'Profil mis à jour avec succès !');

        return $this->redirectToRoute('app_profile');
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