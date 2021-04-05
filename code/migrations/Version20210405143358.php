<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210405143358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_AB5F246BE00EE68D');
        $this->addSql('DROP INDEX IDX_AB5F246B79F37AE5');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_carts AS SELECT id, id_user_id, id_product_id, quantity FROM im2021_carts');
        $this->addSql('DROP TABLE im2021_carts');
        $this->addSql('CREATE TABLE im2021_carts --Table des paniers
        (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_product_id INTEGER NOT NULL, quantity INTEGER NOT NULL, CONSTRAINT FK_AB5F246B79F37AE5 FOREIGN KEY (id_user_id) REFERENCES im2021_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AB5F246BE00EE68D FOREIGN KEY (id_product_id) REFERENCES im2021_products (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO im2021_carts (id, id_user_id, id_product_id, quantity) SELECT id, id_user_id, id_product_id, quantity FROM __temp__im2021_carts');
        $this->addSql('DROP TABLE __temp__im2021_carts');
        $this->addSql('CREATE INDEX IDX_AB5F246BE00EE68D ON im2021_carts (id_product_id)');
        $this->addSql('CREATE INDEX IDX_AB5F246B79F37AE5 ON im2021_carts (id_user_id)');
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
    }
}
