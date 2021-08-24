<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190724013609 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('CREATE TABLE dashboard (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        // $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL, CHANGE icon icon VARCHAR(255) NOT NULL');
        // $this->addSql('ALTER TABLE employee CHANGE state state INT DEFAULT NULL');
        // $this->addSql('ALTER TABLE medic DROP INDEX FK_8422C020A40BC2D5, ADD UNIQUE INDEX UNIQ_8422C020A40BC2D5 (schedule_id)');
        // $this->addSql('ALTER TABLE medic CHANGE state state INT NOT NULL, CHANGE date_start date_start DATE NOT NULL, CHANGE date_end date_end VARCHAR(20) NOT NULL');
        // $this->addSql('ALTER TABLE medic_group CHANGE name name VARCHAR(255) NOT NULL, CHANGE state state INT NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_E546915D5E237E06 ON medic_group (name)');
        $this->addSql('ALTER TABLE patient ADD username VARCHAR(255) NOT NULL, ADD password VARCHAR(255) NOT NULL, CHANGE state state INT NOT NULL, CHANGE photo photo LONGTEXT NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EBF85E0677 ON patient (username)');
        // $this->addSql('ALTER TABLE schedule CHANGE state state INT NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        // $this->addSql('ALTER TABLE vacation CHANGE days_taken days_taken INT DEFAULT NULL, CHANGE observations observations VARCHAR(255) DEFAULT NULL, CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE medic_id medic_id INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE dashboard');
        $this->addSql('ALTER TABLE category CHANGE icon icon VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee CHANGE state state INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medic DROP INDEX UNIQ_8422C020A40BC2D5, ADD INDEX FK_8422C020A40BC2D5 (schedule_id)');
        $this->addSql('ALTER TABLE medic CHANGE state state INT DEFAULT NULL, CHANGE date_start date_start DATE DEFAULT \'NULL\', CHANGE date_end date_end VARCHAR(20) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX UNIQ_E546915D5E237E06 ON medic_group');
        $this->addSql('ALTER TABLE medic_group CHANGE name name LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EBF85E0677 ON patient');
        $this->addSql('ALTER TABLE patient DROP username, DROP password, CHANGE photo photo VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE vacation CHANGE days_taken days_taken INT DEFAULT NULL, CHANGE observations observations VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE employee_id employee_id INT DEFAULT NULL, CHANGE medic_id medic_id INT DEFAULT NULL');
    }
}
