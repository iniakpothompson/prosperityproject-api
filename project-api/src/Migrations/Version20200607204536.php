<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200607204536 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE project_agreement_file (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_payment_receipt_files (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_project_payment_receipt_files (projects_id INT NOT NULL, project_payment_receipt_files_id INT NOT NULL, INDEX IDX_123E5CCD1EDE0F55 (projects_id), INDEX IDX_123E5CCD2253C367 (project_payment_receipt_files_id), PRIMARY KEY(projects_id, project_payment_receipt_files_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_project_agreement_file (projects_id INT NOT NULL, project_agreement_file_id INT NOT NULL, INDEX IDX_1F47550E1EDE0F55 (projects_id), INDEX IDX_1F47550EF0111F7 (project_agreement_file_id), PRIMARY KEY(projects_id, project_agreement_file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receiptfile_details (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, phase VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE receiptfile_details_project_agreement_file (receiptfile_details_id INT NOT NULL, project_agreement_file_id INT NOT NULL, INDEX IDX_3A4AAE0FF3F4F85B (receiptfile_details_id), INDEX IDX_3A4AAE0FF0111F7 (project_agreement_file_id), PRIMARY KEY(receiptfile_details_id, project_agreement_file_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projects_project_payment_receipt_files ADD CONSTRAINT FK_123E5CCD1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_payment_receipt_files ADD CONSTRAINT FK_123E5CCD2253C367 FOREIGN KEY (project_payment_receipt_files_id) REFERENCES project_payment_receipt_files (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_agreement_file ADD CONSTRAINT FK_1F47550E1EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_project_agreement_file ADD CONSTRAINT FK_1F47550EF0111F7 FOREIGN KEY (project_agreement_file_id) REFERENCES project_agreement_file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file ADD CONSTRAINT FK_3A4AAE0FF3F4F85B FOREIGN KEY (receiptfile_details_id) REFERENCES receiptfile_details (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file ADD CONSTRAINT FK_3A4AAE0FF0111F7 FOREIGN KEY (project_agreement_file_id) REFERENCES project_agreement_file (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE projects_project_agreement_file DROP FOREIGN KEY FK_1F47550EF0111F7');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file DROP FOREIGN KEY FK_3A4AAE0FF0111F7');
        $this->addSql('ALTER TABLE projects_project_payment_receipt_files DROP FOREIGN KEY FK_123E5CCD2253C367');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file DROP FOREIGN KEY FK_3A4AAE0FF3F4F85B');
        $this->addSql('DROP TABLE project_agreement_file');
        $this->addSql('DROP TABLE project_payment_receipt_files');
        $this->addSql('DROP TABLE projects_project_payment_receipt_files');
        $this->addSql('DROP TABLE projects_project_agreement_file');
        $this->addSql('DROP TABLE receiptfile_details');
        $this->addSql('DROP TABLE receiptfile_details_project_agreement_file');
    }
}
