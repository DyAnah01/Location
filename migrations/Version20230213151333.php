<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213151333 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences CHANGE adresse adresse VARCHAR(255) NOT NULL, CHANGE ville ville VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE contact ADD email VARCHAR(255) NOT NULL, ADD message LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE membre CHANGE pseudo pseudo VARCHAR(255) NOT NULL, CHANGE mdp mdp VARCHAR(255) NOT NULL, CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE date_enregistrement date_enregistrement DATETIME NOT NULL');
        $this->addSql('ALTER TABLE vehicule CHANGE titre titre VARCHAR(255) NOT NULL, CHANGE marque marque VARCHAR(255) NOT NULL, CHANGE modele modele VARCHAR(255) NOT NULL, CHANGE photo photo VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE agences CHANGE adresse adresse VARCHAR(50) NOT NULL, CHANGE ville ville VARCHAR(50) NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE contact DROP email, DROP message');
        $this->addSql('ALTER TABLE membre CHANGE pseudo pseudo VARCHAR(20) NOT NULL, CHANGE mdp mdp VARCHAR(60) NOT NULL, CHANGE nom nom VARCHAR(20) NOT NULL, CHANGE prenom prenom VARCHAR(20) NOT NULL, CHANGE email email VARCHAR(50) NOT NULL, CHANGE date_enregistrement date_enregistrement DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE vehicule CHANGE titre titre VARCHAR(200) NOT NULL, CHANGE marque marque VARCHAR(50) NOT NULL, CHANGE modele modele VARCHAR(50) NOT NULL, CHANGE photo photo VARCHAR(200) NOT NULL');
    }
}
