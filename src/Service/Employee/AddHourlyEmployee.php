<?php

namespace App\Service\Employee;

use App\Entity\{
    PayrollPaymentMethod,
    PayrollPaymentClassification,
    PaymentDetails,
    EmployeePaymentClassification
};
use App\Service\Payroll\Payment\Classification\HourlyClassification;

class AddHourlyEmployee extends AddPaidEmployee
{
    public function __construct(
        string $fullname,
        protected float $hourlyRate,
        ?string $address = null
    ) {
        parent::__construct($fullname, $address);
    }

    public function validate(): bool
    {
        return false;
    }

    public function getPaymentMethod(): ?PayrollPaymentMethod
    {
        /** @var \App\Repository\PayrollPaymentMethodRepository */
        $methodRepository = $this->entityManager->getRepository(PayrollPaymentMethod::class);
        $holdMethodId = 1;
        return $methodRepository->find($holdMethodId);
    }

    public function getPaymentClassification(): ?EmployeePaymentClassification
    {
        /** @var \App\Repository\PayrollPaymentClassificationRepository */
        $paymentClassRepository = $this->entityManager->getRepository(PayrollPaymentClassification::class);
        $salariedClassificationId = 2;
        $paymentClassification = $paymentClassRepository->find($salariedClassificationId);

        $hourlyClassification = new HourlyClassification();
        $hourlyClassification->hourlyRate = $this->hourlyRate;
        $paymentDetails = new PaymentDetails();
        $paymentDetails->setDetails($hourlyClassification);
        $this->entityManager->persist($paymentDetails);
        
        $employeePaymentClass = new EmployeePaymentClassification();
        $employeePaymentClass->setEmployee($this->employee);
        $employeePaymentClass->setPaymentClassification($paymentClassification);
        $employeePaymentClass->setPaymentDetails($paymentDetails);

        return $employeePaymentClass;
    }

    public function getPaySchedule()
    {
    }
}