<?php

namespace App\Entity;

use App\Repository\EmployeePaymentMethodRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeePaymentMethodRepository::class)]
class EmployeePaymentMethod
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
    private ?PayrollPaymentMethod $payment_method = null;

    #[ORM\Column(updatable: false)]
    private \DateTimeImmutable $created_on;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified_on = null;

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

    public function getPaymentMethod(): ?PayrollPaymentMethod
    {
        return $this->payment_method;
    }

    public function setPaymentMethod(?PayrollPaymentMethod $payment_method): static
    {
        $this->payment_method = $payment_method;

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

    public function getModifiedOn(): ?\DateTimeInterface
    {
        return $this->modified_on;
    }

    public function setModifiedOn(?\DateTimeInterface $modified_on): static
    {
        $this->modified_on = $modified_on;

        return $this;
    }
}
