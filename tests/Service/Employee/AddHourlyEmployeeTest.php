<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\ModelFactory;

use App\Service\Employee\AddHourlyEmployee;
use App\Entity\{
    Employee,
    EmployeePaymentMethod,
    EmployeePaymentClassification,
};
use App\Service\Payroll\Payment\Classification\HourlyClassification;

class AddHourlyEmployeeTest extends KernelTestCase
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
        $employeeName = ModelFactory::faker()->name();
        $employeePaymentHourlyRate = ModelFactory::faker()->randomFloat();
        $transaction = new AddHourlyEmployee($employeeName, $employeePaymentHourlyRate);
        $employee = $transaction->execute($this->entityManager);
        dump($employee);

        $persistedEmployee = $this->entityManager->getRepository(Employee::class)->find($employee->getId());
        $this->assertNotNull($persistedEmployee);
        $this->assertSame($employee, $persistedEmployee);

        $paymentMethodRelationed = $this->entityManager->getRepository(EmployeePaymentMethod::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentMethodRelationed);
        $this->assertInstanceOf(EmployeePaymentMethod::class, $paymentMethodRelationed);
        $this->assertSame($employee, $paymentMethodRelationed->getEmployee());
        
        /** @var \App\Entity\EmployeePaymentClassification */
        $paymentClassRelationed = $this->entityManager->getRepository(EmployeePaymentClassification::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($paymentClassRelationed);
        $this->assertInstanceOf(EmployeePaymentClassification::class, $paymentClassRelationed);
        $this->assertSame($employee, $paymentClassRelationed->getEmployee());

        $paymentDetails = $paymentClassRelationed->getPaymentDetails();
        $this->assertNotNull($paymentDetails);
        dump($paymentDetails);
        $this->assertInstanceOf(HourlyClassification::class, $paymentDetails->getDetails());
        $this->assertEquals($employeePaymentHourlyRate, $paymentDetails->getDetails()->hourlyRate);
    }
}