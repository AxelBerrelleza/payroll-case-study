<?php

namespace App\Service\Employee;

use Doctrine\ORM\EntityManagerInterface;

use App\Utils\Interfaces\EntityTransaction;
use App\Entity\Employee;

class EmployeeElimination implements EntityTransaction
{
    public function __construct(protected int $id)
    {
    }

    public function execute(EntityManagerInterface $entityManager)
    {
        $employee = $entityManager->getRepository(Employee::class)->find($this->id);
        $entityManager->remove($employee);
        $entityManager->flush();
    }
}