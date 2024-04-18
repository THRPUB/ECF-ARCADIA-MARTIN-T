<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129183441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin DROP FOREIGN KEY FK_880E0D761E969C5');
        $this->addSql('DROP INDEX utilisateur_id ON admin');
        $this->addSql('ALTER TABLE admin CHANGE utilisateurs_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194DA1FB054');
        $this->addSql('DROP INDEX IDX_9ABE194DA1FB054 ON animaux');
        $this->addSql('ALTER TABLE animaux DROP visitesVeterinaires_id');
        $this->addSql('ALTER TABLE employes DROP FOREIGN KEY FK_A94BC0F01E969C5');
        $this->addSql('DROP INDEX IDX_A94BC0F01E969C5 ON employes');
        $this->addSql('ALTER TABLE employes CHANGE utilisateurs_id utilisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE habitats DROP FOREIGN KEY FK_B5E492F3A9DAECAA');
        $this->addSql('DROP INDEX IDX_B5E492F3A9DAECAA ON habitats');
        $this->addSql('ALTER TABLE habitats DROP animaux_id');
        $this->addSql('ALTER TABLE veterinaires DROP FOREIGN KEY FK_DE5D2DD7A1FB054');
        $this->addSql('DROP INDEX IDX_DE5D2DD7A1FB054 ON veterinaires');
        $this->addSql('ALTER TABLE veterinaires DROP visitesVeterinaires_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE admin CHANGE utilisateur_id utilisateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE admin ADD CONSTRAINT FK_880E0D761E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX utilisateur_id ON admin (utilisateurs_id)');
        $this->addSql('ALTER TABLE animaux ADD visitesVeterinaires_id INT NOT NULL');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194DA1FB054 FOREIGN KEY (visitesVeterinaires_id) REFERENCES visites_veterinaires (visite_id)');
        $this->addSql('CREATE INDEX IDX_9ABE194DA1FB054 ON animaux (visitesVeterinaires_id)');
        $this->addSql('ALTER TABLE employes CHANGE utilisateur_id utilisateurs_id INT NOT NULL');
        $this->addSql('ALTER TABLE employes ADD CONSTRAINT FK_A94BC0F01E969C5 FOREIGN KEY (utilisateurs_id) REFERENCES utilisateurs (id)');
        $this->addSql('CREATE INDEX IDX_A94BC0F01E969C5 ON employes (utilisateurs_id)');
        $this->addSql('ALTER TABLE habitats ADD animaux_id INT NOT NULL');
        $this->addSql('ALTER TABLE habitats ADD CONSTRAINT FK_B5E492F3A9DAECAA FOREIGN KEY (animaux_id) REFERENCES animaux (animal_id)');
        $this->addSql('CREATE INDEX IDX_B5E492F3A9DAECAA ON habitats (animaux_id)');
        $this->addSql('ALTER TABLE veterinaires ADD visitesVeterinaires_id INT NOT NULL');
        $this->addSql('ALTER TABLE veterinaires ADD CONSTRAINT FK_DE5D2DD7A1FB054 FOREIGN KEY (visitesVeterinaires_id) REFERENCES visites_veterinaires (visite_id)');
        $this->addSql('CREATE INDEX IDX_DE5D2DD7A1FB054 ON veterinaires (visitesVeterinaires_id)');
    }
}
