<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190313003324 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medic ADD schedule_id INT NOT NULL');
        $this->addSql('ALTER TABLE medic ADD CONSTRAINT FK_8422C020A40BC2D5 FOREIGN KEY (schedule_id) REFERENCES schedule (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8422C020A40BC2D5 ON medic (schedule_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E546915D5E237E06 ON medic_group (name)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medic DROP FOREIGN KEY FK_8422C020A40BC2D5');
        $this->addSql('DROP INDEX UNIQ_8422C020A40BC2D5 ON medic');
        $this->addSql('ALTER TABLE medic DROP schedule_id');
        $this->addSql('DROP INDEX UNIQ_E546915D5E237E06 ON medic_group');
    }
}
