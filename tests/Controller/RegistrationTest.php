<?php


namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationTest extends WebTestCase
{
    public function testUserCanRegisterWithValidData(): void
    {
        $client = static::createClient();

        // Accède à la page d'inscription
        $crawler = $client->request('GET', '/register');

        // Remplit le formulaire d'inscription avec les bons noms de champs
        $form = $crawler->selectButton("S'inscrire")->form([
            'registration_form[email]' => 'testuser'.uniqid().'@example.com',
            'registration_form[pseudo]' => 'TestUser',
            'registration_form[plainPassword][first]' => 'Password123!',
            'registration_form[plainPassword][second]' => 'Password123!',
            'registration_form[agreeTerms]' => 1,
            // 'registration_form[receivePromotions]' => 1, // optionnel
        ]);

        $client->submit($form);

        // Suit la redirection vers la page de connexion
        $crawler = $client->followRedirect();

        // Vérifie qu'on arrive bien sur la page de connexion (présence d'un formulaire)
        $this->assertSelectorExists('form');
    }
}