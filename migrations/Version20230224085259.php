<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224085259 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie ADD aventure_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D873DBB5F FOREIGN KEY (aventure_id) REFERENCES aventure (id)');
        $this->addSql('CREATE INDEX IDX_59B1F3D873DBB5F ON partie (aventure_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D873DBB5F');
        $this->addSql('DROP INDEX IDX_59B1F3D873DBB5F ON partie');
        $this->addSql('ALTER TABLE partie DROP aventure_id');
    }
}
