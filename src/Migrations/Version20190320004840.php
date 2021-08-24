<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190320004840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vacation (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, days_taken INT DEFAULT NULL, reason VARCHAR(255) NOT NULL, observations VARCHAR(255) DEFAULT NULL, date_init VARCHAR(255) DEFAULT NULL, employee_id INT DEFAULT NULL, medic_id INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE medic CHANGE state state INT NOT NULL, CHANGE image image TINYTEXT NOT NULL');
        $this->addSql('ALTER TABLE medic_group CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE state state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE vacation');
        $this->addSql('ALTER TABLE category CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE medic CHANGE state state SMALLINT DEFAULT NULL, CHANGE image image BLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE medic_group CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE state state SMALLINT DEFAULT NULL');
    }
}
