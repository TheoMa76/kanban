<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409172648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task_asset (id INT AUTO_INCREMENT NOT NULL, task_asset_type_id INT DEFAULT NULL, content VARCHAR(1500) DEFAULT NULL, INDEX IDX_C50B417CE3B50094 (task_asset_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_asset_type (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task_asset ADD CONSTRAINT FK_C50B417CE3B50094 FOREIGN KEY (task_asset_type_id) REFERENCES task_asset_type (id)');
        $this->addSql('ALTER TABLE tableau DROP FOREIGN KEY FK_C6744DB1A76ED395');
        $this->addSql('ALTER TABLE liste DROP FOREIGN KEY FK_FCF22AF4B062D5BC');
        $this->addSql('ALTER TABLE carte DROP FOREIGN KEY FK_BAD4FFFDE85441D8');
        $this->addSql('DROP TABLE tableau');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE liste');
        $this->addSql('DROP TABLE carte');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tableau (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(1500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C6744DB1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE liste (id INT AUTO_INCREMENT NOT NULL, tableau_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_FCF22AF4B062D5BC (tableau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE carte (id INT AUTO_INCREMENT NOT NULL, liste_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(1500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_BAD4FFFDE85441D8 (liste_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tableau ADD CONSTRAINT FK_C6744DB1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE liste ADD CONSTRAINT FK_FCF22AF4B062D5BC FOREIGN KEY (tableau_id) REFERENCES tableau (id)');
        $this->addSql('ALTER TABLE carte ADD CONSTRAINT FK_BAD4FFFDE85441D8 FOREIGN KEY (liste_id) REFERENCES liste (id)');
        $this->addSql('ALTER TABLE task_asset DROP FOREIGN KEY FK_C50B417CE3B50094');
        $this->addSql('DROP TABLE task_asset');
        $this->addSql('DROP TABLE task_asset_type');
    }
}
