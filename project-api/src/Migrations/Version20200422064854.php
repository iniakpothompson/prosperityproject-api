<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422064854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment_reply (id INT AUTO_INCREMENT NOT NULL, coment_id_id INT NOT NULL, replyer_id INT NOT NULL, reply_message VARCHAR(500) DEFAULT NULL, INDEX IDX_54325E114C20C49B (coment_id_id), INDEX IDX_54325E11C24D9E38 (replyer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_reply ADD CONSTRAINT FK_54325E114C20C49B FOREIGN KEY (coment_id_id) REFERENCES comment (id)');
        $this->addSql('ALTER TABLE comment_reply ADD CONSTRAINT FK_54325E11C24D9E38 FOREIGN KEY (replyer_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment_reply');
    }
}
