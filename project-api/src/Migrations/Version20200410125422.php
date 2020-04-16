<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200410125422 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4A58E0A285');
        $this->addSql('DROP INDEX IDX_219CDA4A58E0A285 ON certificate');
        $this->addSql('ALTER TABLE certificate CHANGE userid_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_219CDA4AA76ED395 ON certificate (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4AA76ED395');
        $this->addSql('DROP INDEX IDX_219CDA4AA76ED395 ON certificate');
        $this->addSql('ALTER TABLE certificate CHANGE user_id userid_id INT NOT NULL');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4A58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_219CDA4A58E0A285 ON certificate (userid_id)');
    }
}
