<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303121913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D836AB213CC');
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D83BCF5E72D');
        $this->addSql('ALTER TABLE lieu_itineraire DROP FOREIGN KEY FK_1D16DBA56AB213CC');
        $this->addSql('ALTER TABLE lieu_itineraire DROP FOREIGN KEY FK_1D16DBA5A9B853B8');
        $this->addSql('DROP TABLE lieu_categorie');
        $this->addSql('DROP TABLE lieu_itineraire');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A9B853B8');
        $this->addSql('DROP INDEX IDX_8F91ABF0A76ED395 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF0A9B853B8 ON avis');
        $this->addSql('ALTER TABLE avis DROP user_id, DROP itineraire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lieu_categorie (lieu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_261A4D836AB213CC (lieu_id), INDEX IDX_261A4D83BCF5E72D (categorie_id), PRIMARY KEY(lieu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE lieu_itineraire (lieu_id INT NOT NULL, itineraire_id INT NOT NULL, INDEX IDX_1D16DBA56AB213CC (lieu_id), INDEX IDX_1D16DBA5A9B853B8 (itineraire_id), PRIMARY KEY(lieu_id, itineraire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D836AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D83BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_itineraire ADD CONSTRAINT FK_1D16DBA56AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_itineraire ADD CONSTRAINT FK_1D16DBA5A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD user_id INT NOT NULL, ADD itineraire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A9B853B8 ON avis (itineraire_id)');
    }
}
