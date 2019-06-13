<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602172306 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game_capsule (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, character_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, damage DOUBLE PRECISION DEFAULT NULL, power INT DEFAULT NULL, defense INT DEFAULT NULL, magic INT DEFAULT NULL, luck INT DEFAULT NULL, speed INT DEFAULT NULL, concentration INT DEFAULT NULL, life INT DEFAULT NULL, energy INT DEFAULT NULL, price INT NOT NULL, INDEX IDX_57AADEACC54C8C93 (type_id), INDEX IDX_57AADEAC1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_capsule_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_equipment (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_equipment_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_capsule ADD CONSTRAINT FK_57AADEACC54C8C93 FOREIGN KEY (type_id) REFERENCES game_capsule_type (id)');
        $this->addSql('ALTER TABLE game_capsule ADD CONSTRAINT FK_57AADEAC1136BE75 FOREIGN KEY (character_id) REFERENCES game_character (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_capsule DROP FOREIGN KEY FK_57AADEACC54C8C93');
        $this->addSql('DROP TABLE game_capsule');
        $this->addSql('DROP TABLE game_capsule_type');
        $this->addSql('DROP TABLE game_equipment');
        $this->addSql('DROP TABLE game_equipment_type');
    }
}
