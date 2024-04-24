<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240424122155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (animal_id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, prenom VARCHAR(255) NOT NULL, race VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, INDEX IDX_6AAB231FAFFE2D26 (habitat_id), PRIMARY KEY(animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis (avis_id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(255) NOT NULL, avis LONGTEXT NOT NULL, validation TINYINT(1) NOT NULL, PRIMARY KEY(avis_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE avis_habitats (id INT AUTO_INCREMENT NOT NULL, nomveterinaire VARCHAR(255) NOT NULL, nomhabitat VARCHAR(255) NOT NULL, avis VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (habitat_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(habitat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horraire_zoo (id INT AUTO_INCREMENT NOT NULL, jour VARCHAR(70) NOT NULL, heure_ouverture VARCHAR(70) NOT NULL, heure_fermeture VARCHAR(70) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pagecontact (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, message LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE passage_employe (passage_id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, nourriture_apportee VARCHAR(255) NOT NULL, grammage_de_la_nourriture VARCHAR(255) NOT NULL, date_de_passage VARCHAR(255) NOT NULL, heure_de_passage VARCHAR(255) NOT NULL, INDEX IDX_C94C8BED8E962C16 (animal_id), PRIMARY KEY(passage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE services (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', api_token VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_veterinaire (visite_id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, etat_animal VARCHAR(255) DEFAULT NULL, nourriture_proposee VARCHAR(255) DEFAULT NULL, grammage_nourriture VARCHAR(255) DEFAULT NULL, date_passage DATE DEFAULT NULL, detail_etat_animal LONGTEXT DEFAULT NULL, nom_veterinaire VARCHAR(255) NOT NULL, INDEX IDX_5C10220E8E962C16 (animal_id), PRIMARY KEY(visite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (habitat_id)');
        $this->addSql('ALTER TABLE passage_employe ADD CONSTRAINT FK_C94C8BED8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (animal_id)');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('ALTER TABLE passage_employe DROP FOREIGN KEY FK_C94C8BED8E962C16');
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E8E962C16');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE avis_habitats');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE horraire_zoo');
        $this->addSql('DROP TABLE pagecontact');
        $this->addSql('DROP TABLE passage_employe');
        $this->addSql('DROP TABLE services');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visite_veterinaire');
    }
}
