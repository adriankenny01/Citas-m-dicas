<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190320063214 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE medic CHANGE state state INT NOT NULL, CHANGE image image TINYTEXT NOT NULL');
        // $this->addSql('ALTER TABLE medic_group CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD date_start VARCHAR(255) NOT NULL, CHANGE state state INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE vacation CHANGE days_taken days_taken INT DEFAULT NULL, CHANGE observations observations VARCHAR(255) DEFAULT NULL, CHANGE date_init date_init VARCHAR(255) DEFAULT NULL, CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE medic_id medic_id INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE user CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE schedule CHANGE state state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee DROP date_start, CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE medic CHANGE state state SMALLINT DEFAULT NULL, CHANGE image image BLOB DEFAULT NULL');
        $this->addSql('ALTER TABLE medic_group CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE vacation CHANGE days_taken days_taken INT DEFAULT NULL, CHANGE observations observations VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE date_init date_init VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE medic_id medic_id INT DEFAULT NULL');
    }
}
