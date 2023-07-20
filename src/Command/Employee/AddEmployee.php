<?php

namespace App\Command\Employee;

use App\Utils\Interfaces\EntityTransaction;
use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class AddEmployee implements EntityTransaction
{
    protected Employee $employee;

    public function __construct(
        string $fullname,
        ?string $address = null
    ) {
        $this->employee = new Employee();
        $this->employee->setFullName($fullname);
        $this->employee->setAddress($address);
    }

    public function execute(EntityManagerInterface $entityManager)
    {
        $entityManager->persist($this->employee);
        $entityManager->flush();
        return $this->employee;
    }
}