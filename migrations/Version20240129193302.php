<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129193302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (administrateur_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32EB52E8FB88E14F (utilisateur_id), PRIMARY KEY(administrateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animal (animal_id INT AUTO_INCREMENT NOT NULL, habitat_id INT DEFAULT NULL, prenom VARCHAR(255) NOT NULL, race VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, INDEX IDX_6AAB231FAFFE2D26 (habitat_id), PRIMARY KEY(animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (employe_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F804D3B9FB88E14F (utilisateur_id), PRIMARY KEY(employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitat (habitat_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(habitat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (utilisateur_id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(20) NOT NULL, PRIMARY KEY(utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (veterinaire_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(veterinaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visite_veterinaire (visite_id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, etat_animal VARCHAR(255) DEFAULT NULL, nourriture_proposee VARCHAR(255) DEFAULT NULL, grammage_nourriture INT DEFAULT NULL, date_passage DATE DEFAULT NULL, detail_etat_animal LONGTEXT DEFAULT NULL, INDEX IDX_5C10220E8E962C16 (animal_id), INDEX IDX_5C10220E5C80924 (veterinaire_id), PRIMARY KEY(visite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FAFFE2D26 FOREIGN KEY (habitat_id) REFERENCES habitat (habitat_id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (animal_id)');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E5C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (veterinaire_id)');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE habitats');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE veterinaires');
        $this->addSql('DROP TABLE visites_veterinaires');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (amin_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, utilisateur_id INT NOT NULL, PRIMARY KEY(amin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE animaux (animal_id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, race VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, habitat_id INT NOT NULL, PRIMARY KEY(animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE employes (employe_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, utilisateur_id INT NOT NULL, PRIMARY KEY(employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE habitats (habitat_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(habitat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE role (role_id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE veterinaires (veterinaire_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(veterinaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE visites_veterinaires (visite_id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, veterinaire_id INT NOT NULL, etat_animal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nourriture_proposée VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, grammage_nourriture VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_passage DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', detail_etat_animal LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(visite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8FB88E14F');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FAFFE2D26');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9FB88E14F');
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E8E962C16');
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E5C80924');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE habitat');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE veterinaire');
        $this->addSql('DROP TABLE visite_veterinaire');
    }
}
