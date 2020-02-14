<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200214085902 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (5, "Oeuf", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (2, "Farine", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (4, "Lait demi-écrémé", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (1, "Bière", NOW(), NOW())');

        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (2, "Spaghetti", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (5, "Lardons", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (4, "Parmesan", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (2, "Poivre", NOW(), NOW())');
        $this->addSql('INSERT INTO food (category_id, name, date_created, date_updated) VALUES (2, "Sel", NOW(), NOW())');


        $this->addSql('INSERT INTO recipe (name, date_created, date_updated, instruction, number_people) VALUES 
            ("Pâte à crêpes", NOW(), NOW(), "Dans un saladier verser la moitié de la farine, puis rajouter les oeufs un à un, rajouter ensuite un peu de lait puis de la farine puis à nouveau du lait et ainsi de suite.Enfin rajouter l\'huile et la bière.Laisser reposer 1 heure, votre pâte est prête.", 4)');
        $this->addSql('INSERT INTO recipe (name, date_created, date_updated, instruction, number_people) VALUES 
            ("Pâtes carbonara", NOW(), NOW(), "Faire cuire les pâtes dans une grande casserole d\'eau salée, le temps indiqué sur le paquet.
            Pendant ce temps, casser les oeufs dans un récipient, ajouter le parmesan râpé, et battre le tout; saler et poivrer.
            Faire cuire les lardons.
            Une fois les pâtes cuites, les égoutter, mais pas trop (toujours garder un peu d\'eau pour les pâtes en sauce).
            Ajouter les lardons, avec leur jus de cuisson, porter à feu très doux et y ajouter la préparation (oeuf, parmesan) en remuant sans arrêt.
            Eteindre le feu avant que la préparation devienne trop sèche !
            Servir chaud, avec un peu de parmesan râpé en plus.", 6)');

        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (1, 1, "x5")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (2, 1, "500g")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (3, 1, "1L")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (4, 1, "1/2 verre")');

        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (5, 2, "500g")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (6, 2, "250g")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (1, 2, "x6")');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (7, 2, null)');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (8, 2, null)');
        $this->addSql('INSERT INTO ingredient (food_id, recipe_id, quantity) VALUES (9, 2, null)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DELETE FROM ingredient');
        $this->addSql('ALTER TABLE ingredient AUTO_INCREMENT = 1');
        $this->addSql('DELETE FROM recipe');
        $this->addSql('ALTER TABLE recipe AUTO_INCREMENT = 1');
        $this->addSql('DELETE FROM food');
        $this->addSql('ALTER TABLE food AUTO_INCREMENT = 1');
    }
}
