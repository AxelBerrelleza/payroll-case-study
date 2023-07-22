<?php

namespace App\Entity;

use App\Repository\PayrollPaymentMethodRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PayrollPaymentMethodRepository::class)]
class PayrollPaymentMethod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 63)]
    private ?string $name = null;

    #[ORM\Column(updatable: false)]
    private \DateTimeImmutable $created_on;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $modified_on = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    public function __construct()
    {
        $this->created_on = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }
}
