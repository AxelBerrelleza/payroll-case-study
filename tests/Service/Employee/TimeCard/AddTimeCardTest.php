<?php

namespace App\Tests\Service\Employee\TimeCard;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\ModelFactory;

use App\Service\Employee\{
    AddHourlyEmployee,
    AddSalariedEmployee,
    TimeCard\AddTimeCard
};
use App\Factory\EmployeeFactory;
use App\Entity\EmployeeTimeCard;
use App\Service\Payroll\Payment\Classification\Exceptions\NotAnHourlyEmployeeException;

class AddTimeCardTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testCreationFailsOnEmployeeWithoutPaymentClassification(): void
    {
        $employeeWithoutPaymentClass = (EmployeeFactory::createOne())->object();
        $date = new \DateTime();
        $amountOfHours = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddTimeCard($employeeWithoutPaymentClass, $date, $amountOfHours);
        $this->expectException(NotAnHourlyEmployeeException::class);
        $timeCardCreation->execute($this->entityManager);
    }

    public function testCreationFailsWhenEmployeeIsNotHourlyPaid(): void
    {
        $name = ModelFactory::faker()->name();
        $salary = ModelFactory::faker()->randomFloat();
        $salariedEmployeeCreation = new AddSalariedEmployee($name, $salary);
        $salariedEmployee = $salariedEmployeeCreation->execute($this->entityManager);
        
        $date = new \DateTime();
        $amountOfHours = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddTimeCard($salariedEmployee, $date, $amountOfHours);
        $this->expectException(NotAnHourlyEmployeeException::class);
        $timeCardCreation->execute($this->entityManager);
    }
    
    public function testTimeCardCreation(): void
    {
        $name = ModelFactory::faker()->name();
        $hourlyRate = ModelFactory::faker()->randomFloat();
        $hourlyEmployeeCreation = new AddHourlyEmployee($name, $hourlyRate);
        $employee = $hourlyEmployeeCreation->execute($this->entityManager);
        
        $date = new \DateTime();
        $amountOfHours = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddTimeCard($employee, $date, $amountOfHours);
        $timeCardCreation->execute($this->entityManager);

        /** @var \App\Repository\EmployeeTimeCardRepository $timeCardRepository */
        $timeCardRepository = $this->entityManager->getRepository(EmployeeTimeCard::class);
        $createdTimeCard = $timeCardRepository->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($createdTimeCard);
        // dump($createdTimeCard);
        $this->assertInstanceOf(EmployeeTimeCard::class, $createdTimeCard);
        $this->assertEquals($employee, $createdTimeCard->getEmployee());
        $this->assertEquals($date, $createdTimeCard->getDate());
        $this->assertEquals($amountOfHours, $createdTimeCard->getHours());
    }
}