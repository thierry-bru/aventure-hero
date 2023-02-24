<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224085609 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie ADD personnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D5E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D5E315342 ON partie (personnage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D5E315342');
        $this->addSql('DROP INDEX IDX_59B1F3D5E315342 ON partie');
        $this->addSql('ALTER TABLE partie DROP personnage_id');
    }
}
