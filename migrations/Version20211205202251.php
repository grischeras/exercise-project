<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211205202251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activities (id INT AUTO_INCREMENT NOT NULL, acitvity_type_id INT DEFAULT NULL, user_id INT DEFAULT NULL, create_dth DATETIME DEFAULT NULL, update_dth DATETIME DEFAULT NULL, delete_dth DATETIME DEFAULT NULL, INDEX IDX_B5F1AFE5E77D70E0 (acitvity_type_id), INDEX IDX_B5F1AFE5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activities_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, place VARCHAR(255) NOT NULL, dth_start DATETIME NOT NULL, dth_end DATETIME NOT NULL, places_available INT NOT NULL, create_dth DATETIME DEFAULT NULL, update_dth DATETIME DEFAULT NULL, delete_dth DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, create_dth DATETIME DEFAULT NULL, update_dth DATETIME DEFAULT NULL, delete_dth DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5E77D70E0 FOREIGN KEY (acitvity_type_id) REFERENCES activities_type (id)');
        $this->addSql('ALTER TABLE activities ADD CONSTRAINT FK_B5F1AFE5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5E77D70E0');
        $this->addSql('ALTER TABLE activities DROP FOREIGN KEY FK_B5F1AFE5A76ED395');
        $this->addSql('DROP TABLE activities');
        $this->addSql('DROP TABLE activities_type');
        $this->addSql('DROP TABLE user');
    }
}
