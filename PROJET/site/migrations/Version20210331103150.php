<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210331103150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE im2021_carts --Table des paniers
        (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_user_id INTEGER NOT NULL, id_product_id INTEGER NOT NULL, quantity INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_AB5F246B79F37AE5 ON im2021_carts (id_user_id)');
        $this->addSql('CREATE INDEX IDX_AB5F246BE00EE68D ON im2021_carts (id_product_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE im2021_carts');
    }
}
