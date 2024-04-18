<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240203103103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite_veterinaire ADD user_id INT NOT NULL');
        $this->addSql('ALTER TABLE visite_veterinaire ADD CONSTRAINT FK_5C10220EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5C10220EA76ED395 ON visite_veterinaire (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE visite_veterinaire DROP FOREIGN KEY FK_5C10220EA76ED395');
        $this->addSql('DROP INDEX IDX_5C10220EA76ED395 ON visite_veterinaire');
        $this->addSql('ALTER TABLE visite_veterinaire DROP user_id');
    }
}
