<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Service\Employee\AddSalariedEmployee;
use App\Entity\{
    Employee,
    EmployeePaymentMethod
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

        $methodRelation = $this->entityManager->getRepository(EmployeePaymentMethod::class)
            ->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($methodRelation);
        $findedEmployee = $methodRelation->getEmployee();
        $this->assertInstanceOf(Employee::class, $findedEmployee);
        dump($employee);
        dump($findedEmployee);
        $this->assertSame($employee, $findedEmployee);
    }
}