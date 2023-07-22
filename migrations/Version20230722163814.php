<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230722163814 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'adding the employees payment methods';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_payment_method_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE payroll_payment_method_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_payment_method (id INT NOT NULL, employee_id INT NOT NULL, payment_method_id INT NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_27A439868C03F15C ON employee_payment_method (employee_id)');
        $this->addSql('CREATE INDEX IDX_27A439865AA1164F ON employee_payment_method (payment_method_id)');
        $this->addSql('COMMENT ON COLUMN employee_payment_method.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE payroll_payment_method (id INT NOT NULL, name VARCHAR(63) NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified_on TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN payroll_payment_method.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE employee_payment_method ADD CONSTRAINT FK_27A439868C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employee_payment_method ADD CONSTRAINT FK_27A439865AA1164F FOREIGN KEY (payment_method_id) REFERENCES payroll_payment_method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery(
            "INSERT INTO payroll_payment_method (id, name, description, created_on) VALUES (nextval('payroll_payment_method_id_seq'), ?, ?, NOW())", 
            ['hold', 'Paymaster holds paycheck for pickup']
        );
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        // $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE employee_payment_method_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE payroll_payment_method_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_payment_method DROP CONSTRAINT FK_27A439868C03F15C');
        $this->addSql('ALTER TABLE employee_payment_method DROP CONSTRAINT FK_27A439865AA1164F');
        $this->addSql('DROP TABLE employee_payment_method');
        $this->addSql('DROP TABLE payroll_payment_method');
    }
}
