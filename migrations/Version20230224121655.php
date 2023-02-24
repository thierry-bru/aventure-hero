<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224121655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aventure ADD etape_finale_id INT DEFAULT NULL, ADD conclusion LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE aventure ADD CONSTRAINT FK_1E56DE4BFADC88E7 FOREIGN KEY (etape_finale_id) REFERENCES etape (id)');
        $this->addSql('CREATE INDEX IDX_1E56DE4BFADC88E7 ON aventure (etape_finale_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE aventure DROP FOREIGN KEY FK_1E56DE4BFADC88E7');
        $this->addSql('DROP INDEX IDX_1E56DE4BFADC88E7 ON aventure');
        $this->addSql('ALTER TABLE aventure DROP etape_finale_id, DROP conclusion');
    }
}
