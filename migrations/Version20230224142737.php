<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224142737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage ADD image_id INT DEFAULT NULL, DROP image');
        $this->addSql('ALTER TABLE personnage ADD CONSTRAINT FK_6AEA486D3DA5256D FOREIGN KEY (image_id) REFERENCES avatar (id)');
        $this->addSql('CREATE INDEX IDX_6AEA486D3DA5256D ON personnage (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personnage DROP FOREIGN KEY FK_6AEA486D3DA5256D');
        $this->addSql('DROP INDEX IDX_6AEA486D3DA5256D ON personnage');
        $this->addSql('ALTER TABLE personnage ADD image VARCHAR(255) NOT NULL, DROP image_id');
    }
}
