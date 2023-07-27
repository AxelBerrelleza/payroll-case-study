<?php

namespace App\Entity;

use App\Repository\PayrollSalariedPaymentClassRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PayrollSalariedPaymentClassRepository::class)]
class PayrollSalariedPaymentClass
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?EmployeePaymentClassification $employee_payment_classification = null;
    
    #[ORM\Column]
    private ?float $salary = null;

    #[ORM\Column]
    private \DateTimeImmutable $created_on;

    public function __construct()
    {
        $this->created_on = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployeePaymentClassification(): ?EmployeePaymentClassification
    {
        return $this->employee_payment_classification;
    }

    public function setEmployeePaymentClassification(EmployeePaymentClassification $employee_payment_classification): static
    {
        $this->employee_payment_classification = $employee_payment_classification;

        return $this;
    }

    public function getSalary(): ?float
    {
        return $this->salary;
    }

    public function setSalary(float $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeImmutable
    {
        return $this->created_on;
    }

    public function setCreatedOn(\DateTimeImmutable $created_on): static
    {
        $this->created_on = $created_on;

        return $this;
    }
}
