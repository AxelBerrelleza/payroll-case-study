<?php

namespace App\Tests\Service\Employee\TimeCard;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\ModelFactory;

use App\Service\Employee\{
    AddCommissionedEmployee,
    AddSalariedEmployee,
    SaleReceipt\AddSaleReceipt
};
use App\Factory\EmployeeFactory;
use App\Entity\EmployeeSaleReceipt;
use App\Service\Payroll\Payment\Classification\Exceptions\NotAnCommissionedEmployeeException;

class AddSaleReceiptTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testCreationFailsOnEmployeeWithoutCommissionedClassification(): void
    {
        $employeeWithoutPaymentClass = (EmployeeFactory::createOne())->object();
        $date = new \DateTime();
        $amountForTheSale = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddSaleReceipt($employeeWithoutPaymentClass, $date, $amountForTheSale);
        $this->expectException(NotAnCommissionedEmployeeException::class);
        $timeCardCreation->execute($this->entityManager);
    }

    public function testCreationFailsWhenEmployeeIsNotHourlyPaid(): void
    {
        $name = ModelFactory::faker()->name();
        $salary = ModelFactory::faker()->randomFloat();
        $salariedEmployeeCreation = new AddSalariedEmployee($name, $salary);
        $salariedEmployee = $salariedEmployeeCreation->execute($this->entityManager);
        
        $date = new \DateTime();
        $amountForTheSale = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddSaleReceipt($salariedEmployee, $date, $amountForTheSale);
        $this->expectException(NotAnCommissionedEmployeeException::class);
        $timeCardCreation->execute($this->entityManager);
    }
    
    public function testTimeCardCreation(): void
    {
        $name = ModelFactory::faker()->name();
        $fakeSalary = ModelFactory::faker()->randomFloat();
        $fakeCommission = ModelFactory::faker()->randomFloat();
        $commissionedEmployeeCreation = new AddCommissionedEmployee($name, $fakeSalary, $fakeCommission);
        $employee = $commissionedEmployeeCreation->execute($this->entityManager);
        
        $date = new \DateTime();
        $amountForTheSale = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddSaleReceipt($employee, $date, $amountForTheSale);
        $timeCardCreation->execute($this->entityManager);

        /** @var \App\Repository\EmployeeSaleReceiptRepository $saleReceiptRepository */
        $saleReceiptRepository = $this->entityManager->getRepository(EmployeeSaleReceipt::class);
        $createdSaleReceipt = $saleReceiptRepository->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($createdSaleReceipt);
        // dump($createdSaleReceipt);
        $this->assertInstanceOf(EmployeeSaleReceipt::class, $createdSaleReceipt);
        $this->assertEquals($employee, $createdSaleReceipt->getEmployee());
        $this->assertEquals($date, $createdSaleReceipt->getDate());
        $this->assertEquals($amountForTheSale, $createdSaleReceipt->getAmount());
    }
}