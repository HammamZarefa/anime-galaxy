<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003211552 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rating_episode (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(255) NOT NULL, episode_id INT NOT NULL, rate_value INT NOT NULL, creation_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE interaction_episode (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(255) NOT NULL, episode_id INT NOT NULL, type INT NOT NULL, creation_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment_episode (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(255) NOT NULL, episode_id INT NOT NULL, comment LONGTEXT NOT NULL, spoiler_alert TINYINT(1) DEFAULT NULL, creation_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE comment_episode');
        $this->addSql('DROP TABLE interaction_episode');
        $this->addSql('DROP TABLE rating_episode');
    }
}