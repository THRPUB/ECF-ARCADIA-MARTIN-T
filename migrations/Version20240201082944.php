<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201082944 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220E5C80924');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', api_token VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE administrateur DROP FOREIGN KEY FK_32EB52E8FB88E14F');
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9FB88E14F');
        $this->addSql('DROP TABLE administrateur');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE veterinaire');
        $this->addSql('DROP INDEX IDX_5C10220E5C80924 ON visite_veterinaire');
        $this->addSql('ALTER TABLE visite_veterinaire DROP veterinaire_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE administrateur (administrateur_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_32EB52E8FB88E14F (utilisateur_id), PRIMARY KEY(administrateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE employe (employe_id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_F804D3B9FB88E14F (utilisateur_id), PRIMARY KEY(employe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (utilisateur_id INT AUTO_INCREMENT NOT NULL, nom_utilisateur VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mot_de_passe VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, role VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(utilisateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE veterinaire (veterinaire_id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(veterinaire_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE administrateur ADD CONSTRAINT FK_32EB52E8FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (utilisateur_id)');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE visite_veterinaire ADD veterinaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220E5C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (veterinaire_id)');
        $this->addSql('CREATE INDEX IDX_5C10220E5C80924 ON visite_veterinaire (veterinaire_id)');
    }
}
