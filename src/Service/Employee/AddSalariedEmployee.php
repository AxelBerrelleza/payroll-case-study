<?php

namespace App\Service\Employee;

// use Doctrine\ORM\EntityManagerInterface;

use App\Entity\{
    PayrollPaymentMethod,
    PayrollPaymentClassification,
    PayrollSalariedPaymentClass,
    EmployeePaymentClassification
};

class AddSalariedEmployee extends AddPaidEmployee
{
    public function __construct(
        string $fullname,
        protected float $salary,
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
        $salariedClassificationId = 1;
        $paymentClassification = $paymentClassRepository->find($salariedClassificationId);

        $employeePaymentClass = new EmployeePaymentClassification();
        $employeePaymentClass->setEmployee($this->employee);
        $employeePaymentClass->setPaymentClassification($paymentClassification);

        $payrollSalariedClass = new PayrollSalariedPaymentClass();
        $payrollSalariedClass->setEmployeePaymentClassification($employeePaymentClass);
        $payrollSalariedClass->setSalary($this->salary);
        $this->entityManager->persist($payrollSalariedClass);

        return $employeePaymentClass;
    }

    public function getPaySchedule()
    {
        
    }
}