<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211103440 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO category (`name`) VALUES ("Boissons")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Céréales et dérivés")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Légumes et fruits")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Lait et produits laitiers")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Viandes, poissons ou oeuf")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Matières grasses")');
        $this->addSql('INSERT INTO category (`name`) VALUES ("Sucre et produits sucrés")');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM category');
        $this->addSql('ALTER TABLE category AUTO_INCREMENT = 1;');
    }
}
