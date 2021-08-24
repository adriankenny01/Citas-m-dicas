<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316142421 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE medic DROP INDEX FK_8422C020A40BC2D5, ADD UNIQUE INDEX UNIQ_8422C020A40BC2D5 (schedule_id)');
        // $this->addSql('ALTER TABLE appoinment CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE medic_group CHANGE state state INT NOT NULL');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_E546915D5E237E06 ON medic_group (name)');
        // $this->addSql('ALTER TABLE employee CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE patient CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD email VARCHAR(255) NOT NULL, DROP user, CHANGE name name VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE state state INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE schedule CHANGE state state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        // $this->addSql('ALTER TABLE appoinment CHANGE state state SMALLINT DEFAULT NULL');
        // $this->addSql('ALTER TABLE category CHANGE state state SMALLINT DEFAULT NULL');
        // $this->addSql('ALTER TABLE employee CHANGE state state SMALLINT DEFAULT NULL');
        // $this->addSql('ALTER TABLE medic DROP INDEX UNIQ_8422C020A40BC2D5, ADD INDEX FK_8422C020A40BC2D5 (schedule_id)');
        // $this->addSql('DROP INDEX UNIQ_E546915D5E237E06 ON medic_group');
        // $this->addSql('ALTER TABLE medic_group CHANGE state state SMALLINT DEFAULT NULL');
        // $this->addSql('ALTER TABLE patient CHANGE state state SMALLINT DEFAULT NULL');
        // $this->addSql('ALTER TABLE schedule CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD user LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, DROP username, DROP email, CHANGE name name VARCHAR(255) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE password password LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE state state SMALLINT DEFAULT NULL');
    }
}
