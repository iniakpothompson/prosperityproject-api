<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501123915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE comment_comment_images (comment_id INT NOT NULL, comment_images_id INT NOT NULL, INDEX IDX_224FF7B1F8697D13 (comment_id), INDEX IDX_224FF7B13D31E4B3 (comment_images_id), PRIMARY KEY(comment_id, comment_images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_comment_images ADD CONSTRAINT FK_224FF7B1F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_comment_images ADD CONSTRAINT FK_224FF7B13D31E4B3 FOREIGN KEY (comment_images_id) REFERENCES comment_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C3DA5256D');
        $this->addSql('DROP INDEX IDX_9474526C3DA5256D ON comment');
        $this->addSql('ALTER TABLE comment DROP image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment_comment_images');
        $this->addSql('ALTER TABLE comment ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C3DA5256D FOREIGN KEY (image_id) REFERENCES comment_images (id)');
        $this->addSql('CREATE INDEX IDX_9474526C3DA5256D ON comment (image_id)');
    }
}
