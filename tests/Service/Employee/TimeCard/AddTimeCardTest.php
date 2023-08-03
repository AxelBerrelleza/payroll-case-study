<?php

namespace App\Tests\Service\Employee\TimeCard;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\ModelFactory;

use App\Service\Employee\TimeCard\AddTimeCard;
use App\Factory\EmployeeFactory;
use App\Entity\EmployeeTimeCard;

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

    public function testTimeCardCreation(): void
    {
        $employee = (EmployeeFactory::createOne())->object();
        $date = new \DateTime();
        $amountOfHours = ModelFactory::faker()->randomFloat();
        $timeCardCreation = new AddTimeCard($employee, $date, $amountOfHours);
        $timeCardCreation->execute($this->entityManager);

        /** @var \App\Repository\EmployeeTimeCardRepository $timeCardRepository */
        $timeCardRepository = $this->entityManager->getRepository(EmployeeTimeCard::class);
        $createdTimeCard = $timeCardRepository->findOneBy(['employee' => $employee->getId()]);
        $this->assertNotNull($createdTimeCard);
        dump($createdTimeCard);
        $this->assertInstanceOf(EmployeeTimeCard::class, $createdTimeCard);
        $this->assertEquals($employee, $createdTimeCard->getEmployee());
        $this->assertEquals($date, $createdTimeCard->getDate());
        $this->assertEquals($amountOfHours, $createdTimeCard->getHours());
    }
}