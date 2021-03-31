<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331101013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE im2021_users --Table des utilisateurs du site
        (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(64) NOT NULL, name VARCHAR(30) DEFAULT NULL, firstname VARCHAR(30) DEFAULT NULL, birth DATE DEFAULT NULL, isadmin BOOLEAN NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F1DCCB2EF85E0677 ON im2021_users (username)');
        $this->addSql('DROP TABLE users');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE users (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(30) NOT NULL COLLATE BINARY, password VARCHAR(64) NOT NULL COLLATE BINARY, name VARCHAR(30) DEFAULT NULL COLLATE BINARY, firstname VARCHAR(30) DEFAULT NULL COLLATE BINARY, birth DATE DEFAULT NULL, isadmin BOOLEAN NOT NULL)');
        $this->addSql('DROP TABLE im2021_users');
    }
}
