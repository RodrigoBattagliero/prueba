<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212225007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO building (id, name) VALUES (1, 'Edificio Wayne')");
        $this->addSql("INSERT INTO floor (id, name, position, status, building_id) VALUES
            (null, 'Planta baja', 1, 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1)),
            (null, 'Piso 1', 2, 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1)),
            (null, 'Piso 2', 3, 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1)),
            (null, 'Piso 3', 4, 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1));
        ");
        $this->addSql("INSERT INTO elevator (id, name, status, building_id) VALUES 
            (null, 'Ascensor 1', 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1)),
            (null, 'Ascensor 2', 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1)),
            (null, 'Ascensor 3', 1, (SELECT id FROM building WHERE name = 'Edificio Wayne' LIMIT 1));
        ");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql("DELETE FROM elevator");
        $this->addSql("DELETE FROM floor");
        $this->addSql("DELETE FROM building");
    }
}
