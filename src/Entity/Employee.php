<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\OneToOne(mappedBy: 'employee', cascade: ['persist', 'remove'])]
    private ?UnionAffiliation $unionAffiliation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): static
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getUnionAffiliation(): ?UnionAffiliation
    {
        return $this->unionAffiliation;
    }

    public function setUnionAffiliation(UnionAffiliation $unionAffiliation): static
    {
        // set the owning side of the relation if necessary
        if ($unionAffiliation->getEmployee() !== $this) {
            $unionAffiliation->setEmployee($this);
        }

        $this->unionAffiliation = $unionAffiliation;

        return $this;
    }
}
