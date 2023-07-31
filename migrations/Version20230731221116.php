<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230731221116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'new records for payroll payment classification';
    }

    public function up(Schema $schema): void
    {
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->executeQuery(
            "INSERT INTO payroll_payment_classification 
                (id, name, description, created_on) VALUES 
                (nextval('payroll_payment_classification_id_seq'), ?, ?, NOW())", 
            ['Hourly', 'They are paid an hourly rate. Salary must be calculated by his timecards.']
        );
        $this->connection->executeQuery(
            "INSERT INTO payroll_payment_classification 
                (id, name, description, created_on) VALUES 
                (nextval('payroll_payment_classification_id_seq'), ?, ?, NOW())", 
            ['Commissioned', 'They are paid by commission, based on their sales receipts.']
        );
    }

    public function down(Schema $schema): void
    {
    }
}
