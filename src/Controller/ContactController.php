<?php

namespace App\Controller;

use App\DTO\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact_index')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $data = new ContactDTO();
        
        /** @var User */
        $user = $this->getUser();
        
        if ($user) {
            $data->email = $user->getEmail();
  }


        $form = $this->createForm(ContactType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            try {
                $mail = (new TemplatedEmail())
                ->from($data->email)
                ->replyTo($data->email)
                ->to('saintecitytour@gmail.com')
                ->subject('Demande de contact')
                ->htmlTemplate('emails/contact.html.twig')
                ->context(['data' => $data]);


                $mailer->send($mail);
                $this->addFlash('success', 'Votre message a été envoyé avec succès.');
                return $this->redirectToRoute('contact_index');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est apparue : ' . $e->getMessage());
                return $this->redirectToRoute('contact_index');
            }
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}