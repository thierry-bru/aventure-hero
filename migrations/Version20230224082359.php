<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224082359 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partie (id INT AUTO_INCREMENT NOT NULL, etape_id INT DEFAULT NULL, date DATETIME NOT NULL, endurance INT NOT NULL, INDEX IDX_59B1F3D4A8CA2AD (etape_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personnage_aventure (personnage_id INT NOT NULL, aventure_id INT NOT NULL, INDEX IDX_697DF1E55E315342 (personnage_id), INDEX IDX_697DF1E5873DBB5F (aventure_id), PRIMARY KEY(personnage_id, aventure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE personnage_aventure ADD CONSTRAINT FK_697DF1E55E315342 FOREIGN KEY (personnage_id) REFERENCES personnage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE personnage_aventure ADD CONSTRAINT FK_697DF1E5873DBB5F FOREIGN KEY (aventure_id) REFERENCES aventure (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D4A8CA2AD');
        $this->addSql('ALTER TABLE personnage_aventure DROP FOREIGN KEY FK_697DF1E55E315342');
        $this->addSql('ALTER TABLE personnage_aventure DROP FOREIGN KEY FK_697DF1E5873DBB5F');
        $this->addSql('DROP TABLE partie');
        $this->addSql('DROP TABLE personnage_aventure');
    }
}
