<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200501121235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE projects_project_images (projects_id INT NOT NULL, project_images_id INT NOT NULL, INDEX IDX_A3EED5EA1EDE0F55 (projects_id), INDEX IDX_A3EED5EAC5734032 (project_images_id), PRIMARY KEY(projects_id, project_images_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projects_project_images ADD CONSTRAINT FK_A3EED5EA1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_images ADD CONSTRAINT FK_A3EED5EAC5734032 FOREIGN KEY (project_images_id) REFERENCES project_images (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A43DA5256D');
        $this->addSql('DROP INDEX IDX_5C93B3A43DA5256D ON projects');
        $this->addSql('ALTER TABLE projects DROP image_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE projects_project_images');
        $this->addSql('ALTER TABLE projects ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A43DA5256D FOREIGN KEY (image_id) REFERENCES project_images (id)');
        $this->addSql('CREATE INDEX IDX_5C93B3A43DA5256D ON projects (image_id)');
    }
}
