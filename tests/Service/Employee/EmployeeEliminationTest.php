<?php

namespace App\Tests\Service\Employee;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use App\Entity\Employee;
use App\Factory\EmployeeFactory;
use App\Service\Employee\EmployeeElimination;

class EmployeeEliminationTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();
        $entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();

        $employee = EmployeeFactory::createOne();
        // dump($employee);
        $exist = $entityManager->getRepository(Employee::class)->find($employee->getId()) <> null;
        $this->assertTrue($exist);

        $elimination = new EmployeeElimination($employee->getId());
        $elimination->execute($entityManager);
        $exist = $entityManager->getRepository(Employee::class)->find($employee->getId()) <> null;
        $this->assertFalse($exist);
    }
}