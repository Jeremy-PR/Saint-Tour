<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250307083331 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itineraire_categorie DROP FOREIGN KEY FK_1F2DEA9EA9B853B8');
        $this->addSql('ALTER TABLE itineraire_categorie DROP FOREIGN KEY FK_1F2DEA9EBCF5E72D');
        $this->addSql('DROP TABLE itineraire_categorie');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itineraire_categorie (itineraire_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_1F2DEA9EA9B853B8 (itineraire_id), INDEX IDX_1F2DEA9EBCF5E72D (categorie_id), PRIMARY KEY(itineraire_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE itineraire_categorie ADD CONSTRAINT FK_1F2DEA9EA9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itineraire_categorie ADD CONSTRAINT FK_1F2DEA9EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
