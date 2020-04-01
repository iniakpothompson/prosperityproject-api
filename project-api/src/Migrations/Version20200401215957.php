<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200401215957 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE certificate (id INT AUTO_INCREMENT NOT NULL, educationid_id INT NOT NULL, userid_id INT NOT NULL, subject VARCHAR(255) NOT NULL, grade VARCHAR(5) NOT NULL, INDEX IDX_219CDA4AC8F853FD (educationid_id), INDEX IDX_219CDA4A58E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, projectid_id INT NOT NULL, message VARCHAR(800) NOT NULL, INDEX IDX_9474526C58E0A285 (userid_id), INDEX IDX_9474526C1BF02654 (projectid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, school VARCHAR(255) NOT NULL, edulevel VARCHAR(255) NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, INDEX IDX_DB0A5ED258E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, userid_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(300) NOT NULL, startdate DATE NOT NULL, enddate DATE NOT NULL, INDEX IDX_590C10358E0A285 (userid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ministries (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_images (id INT AUTO_INCREMENT NOT NULL, file_path VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project_payments (id INT AUTO_INCREMENT NOT NULL, projectid_id INT NOT NULL, purpose VARCHAR(255) NOT NULL, amount NUMERIC(10, 2) NOT NULL, phase VARCHAR(255) NOT NULL, INDEX IDX_589C10E91BF02654 (projectid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, image_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, community VARCHAR(255) NOT NULL, location VARCHAR(255) NOT NULL, lga VARCHAR(255) NOT NULL, startdate DATE NOT NULL, expectedenddate DATE NOT NULL, projectsummary VARCHAR(500) NOT NULL, makepublic TINYINT(1) NOT NULL, INDEX IDX_5C93B3A43DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_ministries (projects_id INT NOT NULL, ministries_id INT NOT NULL, INDEX IDX_8CF1E4B01EDE0F55 (projects_id), INDEX IDX_8CF1E4B0D8602C38 (ministries_id), PRIMARY KEY(projects_id, ministries_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects_user (projects_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_B38D6A811EDE0F55 (projects_id), INDEX IDX_B38D6A81A76ED395 (user_id), PRIMARY KEY(projects_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, careerobjs VARCHAR(255) DEFAULT NULL, sex VARCHAR(20) DEFAULT NULL, dob DATE DEFAULT NULL, phone VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4AC8F853FD FOREIGN KEY (educationid_id) REFERENCES education (id)');
        $this->addSql('ALTER TABLE certificate ADD CONSTRAINT FK_219CDA4A58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1BF02654 FOREIGN KEY (projectid_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED258E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C10358E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project_payments ADD CONSTRAINT FK_589C10E91BF02654 FOREIGN KEY (projectid_id) REFERENCES projects (id)');
        $this->addSql('ALTER TABLE projects ADD CONSTRAINT FK_5C93B3A43DA5256D FOREIGN KEY (image_id) REFERENCES project_images (id)');
        $this->addSql('ALTER TABLE projects_ministries ADD CONSTRAINT FK_8CF1E4B01EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_ministries ADD CONSTRAINT FK_8CF1E4B0D8602C38 FOREIGN KEY (ministries_id) REFERENCES ministries (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_user ADD CONSTRAINT FK_B38D6A811EDE0F55 FOREIGN KEY (projects_id) REFERENCES projects (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE projects_user ADD CONSTRAINT FK_B38D6A81A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4AC8F853FD');
        $this->addSql('ALTER TABLE projects_ministries DROP FOREIGN KEY FK_8CF1E4B0D8602C38');
        $this->addSql('ALTER TABLE projects DROP FOREIGN KEY FK_5C93B3A43DA5256D');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1BF02654');
        $this->addSql('ALTER TABLE project_payments DROP FOREIGN KEY FK_589C10E91BF02654');
        $this->addSql('ALTER TABLE projects_ministries DROP FOREIGN KEY FK_8CF1E4B01EDE0F55');
        $this->addSql('ALTER TABLE projects_user DROP FOREIGN KEY FK_B38D6A811EDE0F55');
        $this->addSql('ALTER TABLE certificate DROP FOREIGN KEY FK_219CDA4A58E0A285');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C58E0A285');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED258E0A285');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C10358E0A285');
        $this->addSql('ALTER TABLE projects_user DROP FOREIGN KEY FK_B38D6A81A76ED395');
        $this->addSql('DROP TABLE certificate');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE ministries');
        $this->addSql('DROP TABLE project_images');
        $this->addSql('DROP TABLE project_payments');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE projects_ministries');
        $this->addSql('DROP TABLE projects_user');
        $this->addSql('DROP TABLE user');
    }
}
