<?php
namespace App\Tests\Entity;

use App\Entity\Lieu;
use PHPUnit\Framework\TestCase;

class LieuTest extends TestCase
{
    public function testLieuEntity(): void
    {
        // Crée une instance de l'entité Lieu
        $lieu = new Lieu();

        // Définit des valeurs pour les propriétés
        $lieu->setName('Place Jean Jaurès');
        $lieu->setAdresse('42000 Saint-Étienne');
        $lieu->setDescription('Un lieu emblématique de Saint-Étienne.');

        // Vérifie que les getters retournent les valeurs définies
        $this->assertEquals('Place Jean Jaurès', $lieu->getName());
        $this->assertEquals('42000 Saint-Étienne', $lieu->getAdresse());
        $this->assertEquals('Un lieu emblématique de Saint-Étienne.', $lieu->getDescription());
    }
}