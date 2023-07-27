<?php

namespace App\Service\Employee;

// use Doctrine\ORM\EntityManagerInterface;

use App\Entity\{
    PayrollPaymentMethod,
    PayrollPaymentClassification
};

class AddSalariedEmployee extends AddPaidEmployee
{
    public function __construct(
        string $fullname,
        float $salary,
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

    public function getPaymentClassification(): ?PayrollPaymentClassification
    {
        /** @var \App\Repository\PayrollPaymentClassificationRepository */
        $paymentClassRepository = $this->entityManager->getRepository(PayrollPaymentClassification::class);
        $salariedClassificationId = 1;
        return $paymentClassRepository->find($salariedClassificationId);
    }

    public function getPaySchedule()
    {
        
    }
}