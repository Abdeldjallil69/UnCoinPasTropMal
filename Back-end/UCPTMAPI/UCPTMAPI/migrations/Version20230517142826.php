<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517142826 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX email ON utilisateurs');
        $this->addSql('ALTER TABLE utilisateurs ADD password VARCHAR(64) NOT NULL, CHANGE pseudo pseudo VARCHAR(64) NOT NULL, CHANGE email email VARCHAR(64) NOT NULL, CHANGE date_creation date_creation DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateurs DROP password, CHANGE pseudo pseudo VARCHAR(50) NOT NULL, CHANGE email email VARCHAR(100) DEFAULT NULL, CHANGE date_creation date_creation VARCHAR(20) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX email ON utilisateurs (email)');
    }
}
