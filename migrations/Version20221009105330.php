<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221009105330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure ADD structure_partner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE structure ADD CONSTRAINT FK_6F0137EAA1DDCCB0 FOREIGN KEY (structure_partner_id) REFERENCES partner (id)');
        $this->addSql('CREATE INDEX IDX_6F0137EAA1DDCCB0 ON structure (structure_partner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure DROP FOREIGN KEY FK_6F0137EAA1DDCCB0');
        $this->addSql('DROP INDEX IDX_6F0137EAA1DDCCB0 ON structure');
        $this->addSql('ALTER TABLE structure DROP structure_partner_id');
    }
}
