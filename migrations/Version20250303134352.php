<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303134352 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itineraire_lieu (itineraire_id INT NOT NULL, lieu_id INT NOT NULL, INDEX IDX_9844E689A9B853B8 (itineraire_id), INDEX IDX_9844E6896AB213CC (lieu_id), PRIMARY KEY(itineraire_id, lieu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itineraire_categorie (itineraire_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_1F2DEA9EA9B853B8 (itineraire_id), INDEX IDX_1F2DEA9EBCF5E72D (categorie_id), PRIMARY KEY(itineraire_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lieu_categorie (lieu_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_261A4D836AB213CC (lieu_id), INDEX IDX_261A4D83BCF5E72D (categorie_id), PRIMARY KEY(lieu_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itineraire_lieu ADD CONSTRAINT FK_9844E689A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itineraire_lieu ADD CONSTRAINT FK_9844E6896AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itineraire_categorie ADD CONSTRAINT FK_1F2DEA9EA9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itineraire_categorie ADD CONSTRAINT FK_1F2DEA9EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D836AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lieu_categorie ADD CONSTRAINT FK_261A4D83BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis ADD user_id INT NOT NULL, ADD avis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0197E709F FOREIGN KEY (avis_id) REFERENCES itineraire (id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0A76ED395 ON avis (user_id)');
        $this->addSql('CREATE INDEX IDX_8F91ABF0197E709F ON avis (avis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itineraire_lieu DROP FOREIGN KEY FK_9844E689A9B853B8');
        $this->addSql('ALTER TABLE itineraire_lieu DROP FOREIGN KEY FK_9844E6896AB213CC');
        $this->addSql('ALTER TABLE itineraire_categorie DROP FOREIGN KEY FK_1F2DEA9EA9B853B8');
        $this->addSql('ALTER TABLE itineraire_categorie DROP FOREIGN KEY FK_1F2DEA9EBCF5E72D');
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D836AB213CC');
        $this->addSql('ALTER TABLE lieu_categorie DROP FOREIGN KEY FK_261A4D83BCF5E72D');
        $this->addSql('DROP TABLE itineraire_lieu');
        $this->addSql('DROP TABLE itineraire_categorie');
        $this->addSql('DROP TABLE lieu_categorie');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0A76ED395');
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0197E709F');
        $this->addSql('DROP INDEX IDX_8F91ABF0A76ED395 ON avis');
        $this->addSql('DROP INDEX IDX_8F91ABF0197E709F ON avis');
        $this->addSql('ALTER TABLE avis DROP user_id, DROP avis_id');
    }
}
