<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425220133 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE game_list_user_character (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, character_id INT NOT NULL, level INT NOT NULL, experience BIGINT NOT NULL, x INT NOT NULL, y INT NOT NULL, power INT NOT NULL, defense INT NOT NULL, magic INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, concentration INT NOT NULL, life INT NOT NULL, energy INT NOT NULL, ki BIGINT NOT NULL, win INT NOT NULL, loose INT NOT NULL, killed INT NOT NULL, death INT NOT NULL, draw INT NOT NULL, INDEX IDX_11FBA1099D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_list_user_character ADD CONSTRAINT FK_11FBA1099D86650F FOREIGN KEY (user_id_id) REFERENCES app_users (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE game_list_user_character');
    }
}
