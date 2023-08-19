<?php

namespace App\Service\Employee\SaleReceipt;

use Doctrine\ORM\EntityManagerInterface;
use \DateTime;

use App\Utils\Interfaces\EntityTransaction;
use App\Entity\{
    Employee,
    EmployeeSaleReceipt,
    EmployeePaymentClassification
};
use App\Repository\{
    EmployeePaymentClassificationRepository,
};
use App\Service\Payroll\Payment\Classification\{
    CommissionedClassification,
    Exceptions\NotAnCommissionedEmployeeException
};

class AddSaleReceipt implements EntityTransaction
{

    public function __construct(
        protected Employee $employee,
        protected DateTime $date,
        protected float $amountOfSale
    ) {
    }

    public function execute(EntityManagerInterface $entityManager)
    {
        $employeePaymentClassificationRepository = $entityManager->getRepository(EmployeePaymentClassification::class);
        $this->assertIsHourlyEmployee($employeePaymentClassificationRepository);
        $saleReceipt = new EmployeeSaleReceipt();
        $saleReceipt->setEmployee($this->employee);
        $saleReceipt->setDate($this->date);
        $saleReceipt->setAmount($this->amountOfSale);

        $entityManager->persist($saleReceipt);
        $entityManager->flush();
    }

    private function assertIsHourlyEmployee(EmployeePaymentClassificationRepository $employeePaymentClassificationRepository)
    {
        $paymentClassificationRecord = $employeePaymentClassificationRepository->findOneBy(['employee' => $this->employee->getId()]);
        if ($paymentClassificationRecord === null) 
            throw new NotAnCommissionedEmployeeException();
        $paymentDetails = $paymentClassificationRecord->getPaymentDetails();
        if (! $paymentDetails->getDetails() instanceof CommissionedClassification)
            throw new NotAnCommissionedEmployeeException();
    }
}