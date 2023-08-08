<?php

namespace App\Service\Employee\TimeCard;

use Doctrine\ORM\EntityManagerInterface;
use \DateTime;

use App\Utils\Interfaces\EntityTransaction;
use App\Entity\{
    Employee,
    EmployeeTimeCard,
    EmployeePaymentClassification
};
use App\Repository\{
    EmployeePaymentClassificationRepository,
};
use App\Service\Payroll\Payment\Classification\{
    HourlyClassification,
    Exceptions\NotAnHourlyEmployeeException
};

class AddTimeCard implements EntityTransaction
{

    public function __construct(
        protected Employee $employee,
        protected DateTime $date,
        protected float $hours
    ) {
    }

    public function execute(EntityManagerInterface $entityManager)
    {
        $employeePaymentClassificationRepository = $entityManager->getRepository(EmployeePaymentClassification::class);
        $this->assertIsHourlyEmployee($employeePaymentClassificationRepository);
        $timeCard = new EmployeeTimeCard();
        $timeCard->setEmployee($this->employee);
        $timeCard->setDate($this->date);
        $timeCard->setHours($this->hours);

        $entityManager->persist($timeCard);
        $entityManager->flush();
    }

    private function assertIsHourlyEmployee(EmployeePaymentClassificationRepository $employeePaymentClassificationRepository)
    {
        $paymentClassificationRecord = $employeePaymentClassificationRepository->findOneBy(['employee' => $this->employee->getId()]);
        if ($paymentClassificationRecord === null) 
            throw new NotAnHourlyEmployeeException();
        $paymentDetails = $paymentClassificationRecord->getPaymentDetails();
        if (! $paymentDetails->getDetails() instanceof HourlyClassification)
            throw new NotAnHourlyEmployeeException();
    }
}