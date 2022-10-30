<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221013054454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE structure_permission_structure (structure_permission_id INT NOT NULL, structure_id INT NOT NULL, INDEX IDX_BDB3DBEFAE933352 (structure_permission_id), INDEX IDX_BDB3DBEF2534008B (structure_id), PRIMARY KEY(structure_permission_id, structure_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE structure_permission_structure ADD CONSTRAINT FK_BDB3DBEFAE933352 FOREIGN KEY (structure_permission_id) REFERENCES structure_permission (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE structure_permission_structure ADD CONSTRAINT FK_BDB3DBEF2534008B FOREIGN KEY (structure_id) REFERENCES structure (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE structure_permission_structure DROP FOREIGN KEY FK_BDB3DBEFAE933352');
        $this->addSql('ALTER TABLE structure_permission_structure DROP FOREIGN KEY FK_BDB3DBEF2534008B');
        $this->addSql('DROP TABLE structure_permission_structure');
    }
}
