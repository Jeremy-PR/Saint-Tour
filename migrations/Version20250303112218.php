<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303112218 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieu_itineraire (lieu_id INT NOT NULL, itineraire_id INT NOT NULL, INDEX IDX_1D16DBA56AB213CC (lieu_id), INDEX IDX_1D16DBA5A9B853B8 (itineraire_id), PRIMARY KEY(lieu_id, itineraire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieu_itineraire ADD CONSTRAINT FK_1D16DBA56AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_itineraire ADD CONSTRAINT FK_1D16DBA5A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis DROP clear');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu_itineraire DROP FOREIGN KEY FK_1D16DBA56AB213CC');
        $this->addSql('ALTER TABLE lieu_itineraire DROP FOREIGN KEY FK_1D16DBA5A9B853B8');
        $this->addSql('DROP TABLE lieu_itineraire');
        $this->addSql('ALTER TABLE avis ADD clear VARCHAR(255) NOT NULL');
    }
}
