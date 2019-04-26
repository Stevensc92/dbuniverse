<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190426190426 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(25) NOT NULL, password VARCHAR(64) NOT NULL, email VARCHAR(60) NOT NULL, is_active TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', password_requested_at DATETIME DEFAULT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_character (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(65) NOT NULL, slug VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, alternative TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_user (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, current_character INT NOT NULL, zenis BIGINT NOT NULL, searches INT NOT NULL, last_refresh_searches_at DATETIME DEFAULT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_6686BA65A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_user_character (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, character_id INT DEFAULT NULL, level INT NOT NULL, experience BIGINT NOT NULL, x INT NOT NULL, y INT NOT NULL, power INT NOT NULL, defense INT NOT NULL, magic INT NOT NULL, luck INT NOT NULL, speed INT NOT NULL, concentration INT NOT NULL, life INT NOT NULL, energy INT NOT NULL, ki BIGINT NOT NULL, win INT NOT NULL, loose INT NOT NULL, killed INT NOT NULL, death INT NOT NULL, draw INT NOT NULL, points_to_distribute INT NOT NULL, INDEX IDX_4950619CA76ED395 (user_id), INDEX IDX_4950619C1136BE75 (character_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game_user ADD CONSTRAINT FK_6686BA65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game_user_character ADD CONSTRAINT FK_4950619CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE game_user_character ADD CONSTRAINT FK_4950619C1136BE75 FOREIGN KEY (character_id) REFERENCES game_character (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game_user DROP FOREIGN KEY FK_6686BA65A76ED395');
        $this->addSql('ALTER TABLE game_user_character DROP FOREIGN KEY FK_4950619CA76ED395');
        $this->addSql('ALTER TABLE game_user_character DROP FOREIGN KEY FK_4950619C1136BE75');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE game_character');
        $this->addSql('DROP TABLE game_user');
        $this->addSql('DROP TABLE game_user_character');
    }
}
