<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190316164844 extends AbstractMigration
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
        $this->addSql('ALTER TABLE medic_group CHANGE state state INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E546915D5E237E06 ON medic_group (name)');
        $this->addSql('ALTER TABLE employee CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL');
        $this->addSql('ALTER TABLE patient CHANGE state state INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE schedule ADD from_hour_day_one TIME NOT NULL, ADD to_hour_day_one TIME NOT NULL, ADD from_hour_day_two TIME NOT NULL, ADD to_hour_day_two TIME NOT NULL, DROP from_hour, DROP to_hour, CHANGE state state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appoinment CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE category CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE employee CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE medic DROP INDEX UNIQ_8422C020A40BC2D5, ADD INDEX FK_8422C020A40BC2D5 (schedule_id)');
        $this->addSql('DROP INDEX UNIQ_E546915D5E237E06 ON medic_group');
        $this->addSql('ALTER TABLE medic_group CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD from_hour TIME NOT NULL, ADD to_hour TIME NOT NULL, DROP from_hour_day_one, DROP to_hour_day_one, DROP from_hour_day_two, DROP to_hour_day_two, CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D649F85E0677 ON user');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
