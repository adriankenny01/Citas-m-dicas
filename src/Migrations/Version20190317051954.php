<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190317051954 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medic  CHANGE date_start date_start VARCHAR(20) NOT NULL, CHANGE date_end date_end VARCHAR(20) NOT NULL');
        // $this->addSql('ALTER TABLE medic_group CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE category CHANGE state state INT NOT NULL');
        // $this->addSql('ALTER TABLE schedule CHANGE state state INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE medic CHANGE state state SMALLINT DEFAULT NULL, CHANGE image image BLOB DEFAULT NULL, CHANGE date_start date_start DATE NOT NULL, CHANGE date_end date_end DATE NOT NULL');
        $this->addSql('ALTER TABLE medic_group CHANGE state state SMALLINT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule CHANGE state state SMALLINT DEFAULT NULL');
    }
}
