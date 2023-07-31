<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731215022 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'replacing the model for employee payment details';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE payroll_salaried_payment_class_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE payment_details_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payment_details (id INT NOT NULL, details JSON NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN payment_details.details IS \'(DC2Type:json_document)\'');
        $this->addSql('COMMENT ON COLUMN payment_details.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payroll_salaried_payment_class DROP CONSTRAINT fk_6f4078b9da97290e');
        $this->addSql('DROP TABLE payroll_salaried_payment_class');
        $this->addSql('ALTER TABLE employee_payment_classification ADD payment_details_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee_payment_classification ADD CONSTRAINT FK_6CF26C338EEC86F7 FOREIGN KEY (payment_details_id) REFERENCES payment_details (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6CF26C338EEC86F7 ON employee_payment_classification (payment_details_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE employee_payment_classification DROP CONSTRAINT FK_6CF26C338EEC86F7');
        $this->addSql('DROP SEQUENCE payment_details_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE payroll_salaried_payment_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payroll_salaried_payment_class (id INT NOT NULL, employee_payment_classification_id INT NOT NULL, salary DOUBLE PRECISION NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX uniq_6f4078b9da97290e ON payroll_salaried_payment_class (employee_payment_classification_id)');
        $this->addSql('COMMENT ON COLUMN payroll_salaried_payment_class.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payroll_salaried_payment_class ADD CONSTRAINT fk_6f4078b9da97290e FOREIGN KEY (employee_payment_classification_id) REFERENCES employee_payment_classification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE payment_details');
        $this->addSql('DROP INDEX UNIQ_6CF26C338EEC86F7');
        $this->addSql('ALTER TABLE employee_payment_classification DROP payment_details_id');
    }
}
