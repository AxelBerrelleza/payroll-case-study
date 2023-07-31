<?php

namespace App\Entity;

use App\Repository\EmployeePaymentClassificationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeePaymentClassificationRepository::class)]
class EmployeePaymentClassification
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PayrollPaymentClassification $payment_classification = null;

    #[ORM\Column]
    private \DateTimeImmutable $created_on;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentDetails $payment_details = null;

    public function __construct()
    {
        $this->created_on = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(Employee $employee): static
    {
        $this->employee = $employee;

        return $this;
    }

    public function getPaymentClassification(): ?PayrollPaymentClassification
    {
        return $this->payment_classification;
    }

    public function setPaymentClassification(?PayrollPaymentClassification $payment_classification): static
    {
        $this->payment_classification = $payment_classification;

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

    public function getPaymentDetails(): ?PaymentDetails
    {
        return $this->payment_details;
    }

    public function setPaymentDetails(PaymentDetails $payment_details): static
    {
        $this->payment_details = $payment_details;

        return $this;
    }
}
