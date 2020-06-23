<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608204300 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE receiptfile_details_project_payment_receipt_files (receiptfile_details_id INT NOT NULL, project_payment_receipt_files_id INT NOT NULL, INDEX IDX_A460251EF3F4F85B (receiptfile_details_id), INDEX IDX_A460251E2253C367 (project_payment_receipt_files_id), PRIMARY KEY(receiptfile_details_id, project_payment_receipt_files_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE receiptfile_details_project_payment_receipt_files ADD CONSTRAINT FK_A460251EF3F4F85B FOREIGN KEY (receiptfile_details_id) REFERENCES receiptfile_details (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receiptfile_details_project_payment_receipt_files ADD CONSTRAINT FK_A460251E2253C367 FOREIGN KEY (project_payment_receipt_files_id) REFERENCES project_payment_receipt_files (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE receiptfile_details_project_agreement_file');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE receiptfile_details_project_agreement_file (receiptfile_details_id INT NOT NULL, project_agreement_file_id INT NOT NULL, INDEX IDX_3A4AAE0FF0111F7 (project_agreement_file_id), INDEX IDX_3A4AAE0FF3F4F85B (receiptfile_details_id), PRIMARY KEY(receiptfile_details_id, project_agreement_file_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file ADD CONSTRAINT FK_3A4AAE0FF0111F7 FOREIGN KEY (project_agreement_file_id) REFERENCES project_agreement_file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE receiptfile_details_project_agreement_file ADD CONSTRAINT FK_3A4AAE0FF3F4F85B FOREIGN KEY (receiptfile_details_id) REFERENCES receiptfile_details (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE receiptfile_details_project_payment_receipt_files');
    }
}
