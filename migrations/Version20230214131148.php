<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230214131148 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agences CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE membre CHANGE pseudo pseudo VARCHAR(255) NOT NULL, CHANGE mdp mdp VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE date_enregistrement date_enregistrement DATETIME NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD fk_agence_id INT DEFAULT NULL, CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE marque marque VARCHAR(255) NOT NULL, CHANGE modele modele VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DB67CE49D FOREIGN KEY (fk_agence_id) REFERENCES agences (id)');
        $this->addSql('CREATE INDEX IDX_292FFF1DB67CE49D ON vehicule (fk_agence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE contact');
        $this->addSql('ALTER TABLE agences CHANGE adresse adresse VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(50) NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE membre CHANGE pseudo pseudo VARCHAR(20) NOT NULL, CHANGE mdp mdp VARCHAR(60) NOT NULL, CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE date_enregistrement date_enregistrement DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DB67CE49D');
        $this->addSql('DROP INDEX IDX_292FFF1DB67CE49D ON vehicule');
        $this->addSql('ALTER TABLE vehicule DROP fk_agence_id, CHANGE titre titre VARCHAR(200) NOT NULL, CHANGE marque marque VARCHAR(50) NOT NULL, CHANGE modele modele VARCHAR(50) NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL');
    }
}
