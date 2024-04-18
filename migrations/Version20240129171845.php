<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129171845 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes ADD utilisateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F01E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_A94BC0F01E969C5 ON employes (utilisateurs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F01E969C5');
        $this->addSql('DROP INDEX IDX_A94BC0F01E969C5 ON employes');
        $this->addSql('ALTER TABLE employes DROP utilisateurs_id');
    }
}
