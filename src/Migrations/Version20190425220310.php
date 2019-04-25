<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190425220310 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_list_user_character DROP FOREIGN KEY FK_11FBA1099D86650F');
        $this->addSql('DROP INDEX IDX_11FBA1099D86650F ON game_list_user_character');
        $this->addSql('ALTER TABLE game_list_user_character CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE game_list_user_character ADD CONSTRAINT FK_11FBA109A76ED395 FOREIGN KEY (user_id) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_11FBA109A76ED395 ON game_list_user_character (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_list_user_character DROP FOREIGN KEY FK_11FBA109A76ED395');
        $this->addSql('DROP INDEX IDX_11FBA109A76ED395 ON game_list_user_character');
        $this->addSql('ALTER TABLE game_list_user_character CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE game_list_user_character ADD CONSTRAINT FK_11FBA1099D86650F FOREIGN KEY (user_id_id) REFERENCES app_users (id)');
        $this->addSql('CREATE INDEX IDX_11FBA1099D86650F ON game_list_user_character (user_id_id)');
    }
}
