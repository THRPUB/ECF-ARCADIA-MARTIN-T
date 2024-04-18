<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203185046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE passage_employe (passage_id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, nourriture_apportee VARCHAR(255) NOT NULL, grammage_de_la_nourriture VARCHAR(255) NOT NULL, date_de_passage VARCHAR(255) NOT NULL, heure_de_passage VARCHAR(255) NOT NULL, INDEX IDX_C94C8BED8E962C16 (animal_id), PRIMARY KEY(passage_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passage_employe ADD CONSTRAINT FK_C94C8BED8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (animal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passage_employe DROP FOREIGN KEY FK_C94C8BED8E962C16');
        $this->addSql('DROP TABLE passage_employe');
    }
}
