<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230727224233 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'new entity that holds salary payment information';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE payroll_salaried_payment_class_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE payroll_salaried_payment_class (id INT NOT NULL, employee_payment_classification_id INT NOT NULL, salary DOUBLE PRECISION NOT NULL, created_on TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6F4078B9DA97290E ON payroll_salaried_payment_class (employee_payment_classification_id)');
        $this->addSql('COMMENT ON COLUMN payroll_salaried_payment_class.created_on IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE payroll_salaried_payment_class ADD CONSTRAINT FK_6F4078B9DA97290E FOREIGN KEY (employee_payment_classification_id) REFERENCES employee_payment_classification (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE payroll_salaried_payment_class_id_seq CASCADE');
        $this->addSql('ALTER TABLE payroll_salaried_payment_class DROP CONSTRAINT FK_6F4078B9DA97290E');
        $this->addSql('DROP TABLE payroll_salaried_payment_class');
    }
}
