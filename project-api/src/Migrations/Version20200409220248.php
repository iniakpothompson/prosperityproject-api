<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409220248 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C58E0A285');
        $this->addSql('DROP INDEX IDX_9474526C58E0A285 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE userid_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526CA76ED395 ON comment (user_id)');
        $this->addSql('ALTER TABLE ministries ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ministries ADD CONSTRAINT FK_3A4E754AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3A4E754AA76ED395 ON ministries (user_id)');
        $this->addSql('ALTER TABLE projects ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A4A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A4A76ED395 ON projects (user_id)');
        $this->addSql('ALTER TABLE user CHANGE designation designation VARCHAR(30) NOT NULL, CHANGE roles roles TINYTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('DROP INDEX IDX_9474526CA76ED395 ON comment');
        $this->addSql('ALTER TABLE comment CHANGE user_id userid_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C58E0A285 ON comment (userid_id)');
        $this->addSql('ALTER TABLE ministries DROP FOREIGN KEY FK_3A4E754AA76ED395');
        $this->addSql('DROP INDEX IDX_3A4E754AA76ED395 ON ministries');
        $this->addSql('ALTER TABLE ministries DROP user_id');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A4A76ED395');
        $this->addSql('DROP INDEX IDX_5C93B3A4A76ED395 ON projects');
        $this->addSql('ALTER TABLE projects DROP user_id');
        $this->addSql('ALTER TABLE user CHANGE designation designation VARCHAR(30) CHARACTER SET utf8mb4 DEFAULT \'COMMENTATOR\' NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles TINYTEXT CHARACTER SET utf8mb4 DEFAULT \'ROLE_COMMENTATOR\' NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:simple_array)\'');
    }
}
