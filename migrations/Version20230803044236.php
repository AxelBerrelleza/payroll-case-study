<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230803044236 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'basic timecard creation';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_time_card_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_time_card (id INT NOT NULL, employee_id INT NOT NULL, date DATE NOT NULL, hours DOUBLE PRECISION NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BE39F9BC8C03F15C ON employee_time_card (employee_id)');
        $this->addSql('COMMENT ON COLUMN employee_time_card.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE employee_time_card ADD CONSTRAINT FK_BE39F9BC8C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE employee_time_card_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_time_card DROP CONSTRAINT FK_BE39F9BC8C03F15C');
        $this->addSql('DROP TABLE employee_time_card');
    }
}
