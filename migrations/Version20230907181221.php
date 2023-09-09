<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230907181221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE "union_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE union_affiliation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE union_service_charge_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE "union" (id INT NOT NULL, name VARCHAR(24) NOT NULL, description VARCHAR(128) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE union_affiliation (id INT NOT NULL, employee_id INT NOT NULL, union_entity_id INT NOT NULL, dues DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_953C76728C03F15C ON union_affiliation (employee_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_953C76725B7F97AE ON union_affiliation (union_entity_id)');
        $this->addSql('CREATE TABLE union_service_charge (id INT NOT NULL, member_id_id INT NOT NULL, date DATE NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C706AC201D650BA4 ON union_service_charge (member_id_id)');
        $this->addSql('COMMENT ON COLUMN union_service_charge.date IS \'(DC2Type:date_immutable)\'');
        $this->addSql('ALTER TABLE union_affiliation ADD CONSTRAINT FK_953C76728C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE union_affiliation ADD CONSTRAINT FK_953C76725B7F97AE FOREIGN KEY (union_entity_id) REFERENCES "union" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE union_service_charge ADD CONSTRAINT FK_C706AC201D650BA4 FOREIGN KEY (member_id_id) REFERENCES union_affiliation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE "union_id_seq" CASCADE');
        $this->addSql('DROP SEQUENCE union_affiliation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE union_service_charge_id_seq CASCADE');
        $this->addSql('ALTER TABLE union_affiliation DROP CONSTRAINT FK_953C76728C03F15C');
        $this->addSql('ALTER TABLE union_affiliation DROP CONSTRAINT FK_953C76725B7F97AE');
        $this->addSql('ALTER TABLE union_service_charge DROP CONSTRAINT FK_C706AC201D650BA4');
        $this->addSql('DROP TABLE "union"');
        $this->addSql('DROP TABLE union_affiliation');
        $this->addSql('DROP TABLE union_service_charge');
    }
}
