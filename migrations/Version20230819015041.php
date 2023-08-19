<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230819015041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE employee_sale_receipt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE employee_sale_receipt (id INT NOT NULL, employee_id INT NOT NULL, date DATE NOT NULL, amount DOUBLE PRECISION NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8B25F978C03F15C ON employee_sale_receipt (employee_id)');
        $this->addSql('ALTER TABLE employee_sale_receipt ADD CONSTRAINT FK_8B25F978C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE employee_sale_receipt_id_seq CASCADE');
        $this->addSql('ALTER TABLE employee_sale_receipt DROP CONSTRAINT FK_8B25F978C03F15C');
        $this->addSql('DROP TABLE employee_sale_receipt');
    }
}
