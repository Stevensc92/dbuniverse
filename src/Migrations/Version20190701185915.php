<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190701185915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game_user_inventory (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, user_character_id INT DEFAULT NULL, capsule_id INT DEFAULT NULL, equipment_id INT DEFAULT NULL, level INT NOT NULL, experience INT NOT NULL, INDEX IDX_6B079B9EA76ED395 (user_id), INDEX IDX_6B079B9E91FAC277 (user_character_id), UNIQUE INDEX UNIQ_6B079B9E714704E9 (capsule_id), UNIQUE INDEX UNIQ_6B079B9E517FE9FE (equipment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_user_inventory ADD CONSTRAINT FK_6B079B9EA76ED395 FOREIGN KEY (user_id) REFERENCES game_user (id)');
        $this->addSql('ALTER TABLE game_user_inventory ADD CONSTRAINT FK_6B079B9E91FAC277 FOREIGN KEY (user_character_id) REFERENCES game_user_character (id)');
        $this->addSql('ALTER TABLE game_user_inventory ADD CONSTRAINT FK_6B079B9E714704E9 FOREIGN KEY (capsule_id) REFERENCES game_capsule (id)');
        $this->addSql('ALTER TABLE game_user_inventory ADD CONSTRAINT FK_6B079B9E517FE9FE FOREIGN KEY (equipment_id) REFERENCES game_equipment (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE game_user_inventory');
    }
}
