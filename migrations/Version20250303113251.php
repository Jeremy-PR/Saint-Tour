<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303113251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieu_categorie (lieu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_261A4D836AB213CC (lieu_id), INDEX IDX_261A4D83BCF5E72D (categorie_id), PRIMARY KEY(lieu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D836AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D83BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D836AB213CC');
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D83BCF5E72D');
        $this->addSql('DROP TABLE lieu_categorie');
    }
}
