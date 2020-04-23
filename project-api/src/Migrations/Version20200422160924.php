<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422160924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_reply DROP FOREIGN KEY FK_54325E11C24D9E38');
        $this->addSql('DROP INDEX IDX_54325E11C24D9E38 ON comment_reply');
        $this->addSql('ALTER TABLE comment_reply ADD date DATE NOT NULL, CHANGE replyer_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment_reply ADD CONSTRAINT FK_54325E11A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_54325E11A76ED395 ON comment_reply (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment_reply DROP FOREIGN KEY FK_54325E11A76ED395');
        $this->addSql('DROP INDEX IDX_54325E11A76ED395 ON comment_reply');
        $this->addSql('ALTER TABLE comment_reply DROP date, CHANGE user_id replyer_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment_reply ADD CONSTRAINT FK_54325E11C24D9E38 FOREIGN KEY (replyer_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_54325E11C24D9E38 ON comment_reply (replyer_id)');
    }
}
