<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\Employee;
use App\Service\Employee\AddEmployee;

class AddEmployeeTest extends KernelTestCase
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
        $fullname = "Axel";
        $transaction = new AddEmployee($fullname);
        $employee = $transaction->execute($this->entityManager);
        $this->assertNotNull($employee);
        $this->assertInstanceOf(Employee::class, $employee);
        $this->assertSame($fullname, $employee->getFullName());
        $newEmployeeId = $employee->getId();
        $this->assertNotNull($newEmployeeId);

        $employeeRepository = $this->entityManager->getRepository(Employee::class);
        $employeeResponse = $employeeRepository->findOneBy(['full_name' => $fullname]);
        $this->assertNotNull($employeeResponse);
        $this->assertInstanceOf(Employee::class, $employee);

        $this->assertSame($employee, $employeeResponse);
    }
}