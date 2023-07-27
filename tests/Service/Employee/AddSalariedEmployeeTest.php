<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Service\Employee\AddSalariedEmployee;
use App\Entity\{
    Employee,
    EmployeePaymentMethod,
    EmployeePaymentClassification
};

class AddSalariedEmployeeTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testTransaction(): void
    {
        $employeeName = 'Axel 2';
        $transaction = new AddSalariedEmployee($employeeName, 20.00);
        $employee = $transaction->execute($this->entityManager);

        $persistedEmployee = $this->entityManager->getRepository(Employee::class)->find($employee->getId());
        $this->assertNotNull($persistedEmployee);
        $this->assertSame($employee, $persistedEmployee);

        $paymentMethodRelationed = $this->entityManager->getRepository(EmployeePaymentMethod::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentMethodRelationed);
        $findedEmployee = $paymentMethodRelationed->getEmployee();
        $this->assertInstanceOf(Employee::class, $findedEmployee);
        $this->assertSame($employee, $findedEmployee);
        // dump($employee);
        // dump($findedEmployee);
        $paymentClassRelationed = $this->entityManager->getRepository(EmployeePaymentClassification::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentClassRelationed);
        $this->assertSame($employee, $paymentClassRelationed->getEmployee());
    }
}