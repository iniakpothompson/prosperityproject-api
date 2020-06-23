<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200522200321 extends AbstractMigration
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
        $this->addSql('CREATE TABLE projects_project_images (projects_id INT NOT NULL, project_images_id INT NOT NULL, INDEX IDX_A3EED5EA1EDE0F55 (projects_id), INDEX IDX_A3EED5EAC5734032 (project_images_id), PRIMARY KEY(projects_id, project_images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment_comment_images ADD CONSTRAINT FK_224FF7B1F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_comment_images ADD CONSTRAINT FK_224FF7B13D31E4B3 FOREIGN KEY (comment_images_id) REFERENCES comment_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_images ADD CONSTRAINT FK_A3EED5EA1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_images ADD CONSTRAINT FK_A3EED5EAC5734032 FOREIGN KEY (project_images_id) REFERENCES project_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE comment_images DROP FOREIGN KEY FK_2A0CE678F8697D13');
        $this->addSql('DROP INDEX IDX_2A0CE678F8697D13 ON comment_images');
        $this->addSql('ALTER TABLE comment_images DROP comment_id');
        $this->addSql('ALTER TABLE project_images DROP FOREIGN KEY FK_F7BB5520166D1F9C');
        $this->addSql('DROP INDEX IDX_F7BB5520166D1F9C ON project_images');
        $this->addSql('ALTER TABLE project_images DROP project_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE comment_comment_images');
        $this->addSql('DROP TABLE projects_project_images');
        $this->addSql('ALTER TABLE comment_images ADD comment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment_images ADD CONSTRAINT FK_2A0CE678F8697D13 FOREIGN KEY (comment_id) REFERENCES comment (id)');
        $this->addSql('CREATE INDEX IDX_2A0CE678F8697D13 ON comment_images (comment_id)');
        $this->addSql('ALTER TABLE project_images ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project_images ADD CONSTRAINT FK_F7BB5520166D1F9C FOREIGN KEY (project_id) REFERENCES projects (id)');
        $this->addSql('CREATE INDEX IDX_F7BB5520166D1F9C ON project_images (project_id)');
    }
}
