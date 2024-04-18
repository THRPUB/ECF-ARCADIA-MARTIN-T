<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129143725 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (amin_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(amin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animaux (animal_id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) NOT NULL, race VARCHAR(255) NOT NULL, image_url VARCHAR(255) NOT NULL, habitat_id INT NOT NULL, PRIMARY KEY(animal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employes (employe_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE habitats (habitat_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, image_url VARCHAR(255) NOT NULL, PRIMARY KEY(habitat_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (role_id INT AUTO_INCREMENT NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT NOT NULL, nom_utilisateur VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaires (veterinaire_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(veterinaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visites_veterinaires (visite_id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, veterinaire_id INT NOT NULL, etat_animal VARCHAR(255) NOT NULL, nourriture_proposée VARCHAR(255) NOT NULL, grammage_nourriture VARCHAR(255) NOT NULL, date_passage DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', detail_etat_animal LONGTEXT NOT NULL, PRIMARY KEY(visite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE employes');
        $this->addSql('DROP TABLE habitats');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateurs');
        $this->addSql('DROP TABLE veterinaires');
        $this->addSql('DROP TABLE visites_veterinaires');
    }
}
