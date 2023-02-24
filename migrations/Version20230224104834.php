<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224104834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE alternative (id INT AUTO_INCREMENT NOT NULL, etape_suivante_id INT DEFAULT NULL, texte_ambiance VARCHAR(255) NOT NULL, INDEX IDX_EFF5DFA62A0957E (etape_suivante_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alternative_etape (alternative_id INT NOT NULL, etape_id INT NOT NULL, INDEX IDX_27683BFFC05FFAC (alternative_id), INDEX IDX_27683BF4A8CA2AD (etape_id), PRIMARY KEY(alternative_id, etape_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE alternative ADD CONSTRAINT FK_EFF5DFA62A0957E FOREIGN KEY (etape_suivante_id) REFERENCES etape (id)');
        $this->addSql('ALTER TABLE alternative_etape ADD CONSTRAINT FK_27683BFFC05FFAC FOREIGN KEY (alternative_id) REFERENCES alternative (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE alternative_etape ADD CONSTRAINT FK_27683BF4A8CA2AD FOREIGN KEY (etape_id) REFERENCES etape (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etape DROP FOREIGN KEY FK_285F75DD3F94EAC8');
        $this->addSql('DROP INDEX IDX_285F75DD3F94EAC8 ON etape');
        $this->addSql('ALTER TABLE etape DROP etape_precedente_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE alternative DROP FOREIGN KEY FK_EFF5DFA62A0957E');
        $this->addSql('ALTER TABLE alternative_etape DROP FOREIGN KEY FK_27683BFFC05FFAC');
        $this->addSql('ALTER TABLE alternative_etape DROP FOREIGN KEY FK_27683BF4A8CA2AD');
        $this->addSql('DROP TABLE alternative');
        $this->addSql('DROP TABLE alternative_etape');
        $this->addSql('ALTER TABLE etape ADD etape_precedente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE etape ADD CONSTRAINT FK_285F75DD3F94EAC8 FOREIGN KEY (etape_precedente_id) REFERENCES etape (id)');
        $this->addSql('CREATE INDEX IDX_285F75DD3F94EAC8 ON etape (etape_precedente_id)');
    }
}
