<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Service\Employee\AddSalariedEmployee;
use App\Entity\{
    Employee,
    EmployeePaymentMethod,
    EmployeePaymentClassification,
    PayrollSalariedPaymentClass
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
        $employeeSalary = 20.00;
        $transaction = new AddSalariedEmployee($employeeName, $employeeSalary);
        $employee = $transaction->execute($this->entityManager);

        $persistedEmployee = $this->entityManager->getRepository(Employee::class)->find($employee->getId());
        $this->assertNotNull($persistedEmployee);
        $this->assertSame($employee, $persistedEmployee);

        $paymentMethodRelationed = $this->entityManager->getRepository(EmployeePaymentMethod::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentMethodRelationed);
        $this->assertInstanceOf(EmployeePaymentMethod::class, $paymentMethodRelationed);
        $this->assertSame($employee, $paymentMethodRelationed->getEmployee());
        
        $paymentClassRelationed = $this->entityManager->getRepository(EmployeePaymentClassification::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentClassRelationed);
        $this->assertInstanceOf(EmployeePaymentClassification::class, $paymentClassRelationed);
        $this->assertSame($employee, $paymentClassRelationed->getEmployee());

        $salariedClass = $this->entityManager->getRepository(PayrollSalariedPaymentClass::class)
            ->findOneBy(['employee_payment_classification' => $paymentClassRelationed->getId()]);
        $this->assertNotNull($salariedClass);
        $this->assertInstanceOf(PayrollSalariedPaymentClass::class, $salariedClass);
        $this->assertSame($paymentClassRelationed, $salariedClass->getEmployeePaymentClassification());
        $this->assertEquals($employeeSalary, $salariedClass->getSalary());
    }
}