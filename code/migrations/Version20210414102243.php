<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210414102243 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_AB5F246B79F37AE5');
        $this->addSql('DROP INDEX IDX_AB5F246BE00EE68D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_carts AS SELECT id, id_user_id, id_product_id, quantity FROM im2021_carts');
        $this->addSql('DROP TABLE im2021_carts');
        $this->addSql('CREATE TABLE im2021_carts --Table des paniers
        (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_AB5F246B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES im2021_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AB5F246BE00EE68D FOREIGN KEY (id_product_id) REFERENCES im2021_products (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) SELECT id, id_user_id, id_product_id, quantity FROM __temp__im2021_carts');
        $this->addSql('DROP TABLE __temp__im2021_carts');
        $this->addSql('CREATE INDEX IDX_AB5F246B79F37AE5 ON im2021_carts (id_user_id)');
        $this->addSql('CREATE INDEX IDX_AB5F246BE00EE68D ON im2021_carts (id_product_id)');
        $this->addSql('DROP INDEX UNIQ_F1DCCB2EF85E0677');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_users AS SELECT pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin FROM im2021_users');
        $this->addSql('DROP TABLE im2021_users');
        $this->addSql('CREATE TABLE im2021_users (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) DEFAULT NULL COLLATE BINARY, prenom VARCHAR(30) DEFAULT NULL COLLATE BINARY, anniversaire DATE DEFAULT NULL, identifiant VARCHAR(30) NOT NULL --sert de login (doit être unique)
        , motdepasse VARCHAR(64) NOT NULL --mot de passe crypté : il faut une taille assez grande pour ne pas le tronquer
        , isadmin SMALLINT NOT NULL --type booléen
        )');
        $this->addSql('INSERT INTO im2021_users (pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin) SELECT pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin FROM __temp__im2021_users');
        $this->addSql('DROP TABLE __temp__im2021_users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F1DCCB2EC90409EC ON im2021_users (identifiant)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_AB5F246B79F37AE5');
        $this->addSql('DROP INDEX IDX_AB5F246BE00EE68D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_carts AS SELECT id, id_user_id, id_product_id, quantity FROM im2021_carts');
        $this->addSql('DROP TABLE im2021_carts');
        $this->addSql('CREATE TABLE im2021_carts --Table des paniers
        (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_product_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) SELECT id, id_user_id, id_product_id, quantity FROM __temp__im2021_carts');
        $this->addSql('DROP TABLE __temp__im2021_carts');
        $this->addSql('CREATE INDEX IDX_AB5F246B79F37AE5 ON im2021_carts (id_user_id)');
        $this->addSql('CREATE INDEX IDX_AB5F246BE00EE68D ON im2021_carts (id_product_id)');
        $this->addSql('DROP INDEX UNIQ_F1DCCB2EC90409EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_users AS SELECT pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin FROM im2021_users');
        $this->addSql('DROP TABLE im2021_users');
        $this->addSql('CREATE TABLE im2021_users --Table des utilisateurs du site
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, nom VARCHAR(30) DEFAULT NULL, prenom VARCHAR(30) DEFAULT NULL, anniversaire DATE DEFAULT NULL, identifiant VARCHAR(30) NOT NULL COLLATE BINARY, motdepasse VARCHAR(64) NOT NULL COLLATE BINARY, isadmin INTEGER NOT NULL)');
        $this->addSql('INSERT INTO im2021_users (pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin) SELECT pk, identifiant, motdepasse, nom, prenom, anniversaire, isadmin FROM __temp__im2021_users');
        $this->addSql('DROP TABLE __temp__im2021_users');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F1DCCB2EF85E0677 ON im2021_users (identifiant)');
    }
}
