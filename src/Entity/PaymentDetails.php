<?php

namespace App\Entity;

use App\Repository\PaymentDetailsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentDetailsRepository::class)]
class PaymentDetails
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'json_document')]
    private $details = null;

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

    public function getDetails()
    {
        return $this->details;
    }

    public function setDetails($details): static
    {
        $this->details = $details;

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
