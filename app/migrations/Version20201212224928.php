<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201212224928 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE building (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE elevator (id INT AUTO_INCREMENT NOT NULL, building_id INT NOT NULL, current_floor_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_1398EB334D2A7E12 (building_id), UNIQUE INDEX UNIQ_1398EB33183E03C8 (current_floor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE floor (id INT AUTO_INCREMENT NOT NULL, building_id INT NOT NULL, name VARCHAR(255) NOT NULL, position INT NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_BE45D62E4D2A7E12 (building_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE elevator ADD CONSTRAINT FK_1398EB334D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
        $this->addSql('ALTER TABLE elevator ADD CONSTRAINT FK_1398EB33183E03C8 FOREIGN KEY (current_floor_id) REFERENCES floor (id)');
        $this->addSql('ALTER TABLE floor ADD CONSTRAINT FK_BE45D62E4D2A7E12 FOREIGN KEY (building_id) REFERENCES building (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elevator DROP FOREIGN KEY FK_1398EB334D2A7E12');
        $this->addSql('ALTER TABLE floor DROP FOREIGN KEY FK_BE45D62E4D2A7E12');
        $this->addSql('ALTER TABLE elevator DROP FOREIGN KEY FK_1398EB33183E03C8');
        $this->addSql('DROP TABLE building');
        $this->addSql('DROP TABLE elevator');
        $this->addSql('DROP TABLE floor');
    }
}
