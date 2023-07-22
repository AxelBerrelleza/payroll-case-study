<?php

namespace App\Service\Employee;

use App\Utils\Interfaces\EntityTransaction;
use App\Entity\{
    Employee,
    PayrollPaymentMethod,
    EmployeePaymentMethod
};
use Doctrine\ORM\EntityManagerInterface;

abstract class AddPaidEmployee extends \App\Command\Employee\AddEmployee implements EntityTransaction
{
    protected Employee $employee;
    protected EntityManagerInterface $entityManager;

    public function execute(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->validate();

        $entityManager->persist($this->employee);
        $entityManager->persist($this->createEmployeePaymentMethod());

        $entityManager->flush();
        return $this->employee;
    }

    abstract public function validate(): bool;

    protected function createEmployeePaymentMethod()
    {
        $methodRecord = new EmployeePaymentMethod();
        $methodRecord->setEmployee($this->employee);
        $methodRecord->setPaymentMethod($this->getPaymentMethod());
        
        return $methodRecord;
    }
    
    abstract public function getPaymentMethod(): ?PayrollPaymentMethod;

    abstract public function getPaymentClassification();

    abstract public function getPaySchedule();
}