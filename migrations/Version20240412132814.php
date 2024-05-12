<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240412132814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, position VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, step_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_527EDB2573B21E9C (step_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_history (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, event VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, event_date DATETIME NOT NULL, INDEX IDX_385B5AA18DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB2573B21E9C FOREIGN KEY (step_id) REFERENCES step (id)');
        $this->addSql('ALTER TABLE task_history ADD CONSTRAINT FK_385B5AA18DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB2573B21E9C');
        $this->addSql('ALTER TABLE task_history DROP FOREIGN KEY FK_385B5AA18DB60186');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE step');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_history');
    }
}
