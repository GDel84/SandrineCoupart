<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919090822 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ingredients (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libeller VARCHAR(255) DEFAULT NULL, allergene VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE regimes_users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, pass_word VARCHAR(255) DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, regimes VARCHAR(255) DEFAULT NULL)');
        $this->addSql('ALTER TABLE regimes ADD COLUMN libeller VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE regimes_users');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__regimes AS SELECT id FROM regimes');
        $this->addSql('DROP TABLE regimes');
        $this->addSql('CREATE TABLE regimes (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('INSERT INTO regimes (id) SELECT id FROM __temp__regimes');
        $this->addSql('DROP TABLE __temp__regimes');
    }
}
