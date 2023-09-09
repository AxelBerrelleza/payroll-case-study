<?php

namespace App\Entity;

use App\Repository\UnionAffiliationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UnionAffiliationRepository::class)]
class UnionAffiliation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'unionAffiliation', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Employee $employee = null;

    #[ORM\Column]
    private ?float $dues = null;

    #[ORM\OneToMany(mappedBy: 'memberId', targetEntity: UnionServiceCharge::class, orphanRemoval: true)]
    private Collection $serviceCharges;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Union $union_entity = null;

    public function __construct()
    {
        $this->serviceCharges = new ArrayCollection();
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

    public function getDues(): ?float
    {
        return $this->dues;
    }

    public function setDues(float $dues): static
    {
        $this->dues = $dues;

        return $this;
    }

    /**
     * @return Collection<int, UnionServiceCharge>
     */
    public function getServiceCharges(): Collection
    {
        return $this->serviceCharges;
    }

    public function addServiceCharge(UnionServiceCharge $serviceCharge): static
    {
        if (!$this->serviceCharges->contains($serviceCharge)) {
            $this->serviceCharges->add($serviceCharge);
            $serviceCharge->setMemberId($this);
        }

        return $this;
    }

    public function removeServiceCharge(UnionServiceCharge $serviceCharge): static
    {
        if ($this->serviceCharges->removeElement($serviceCharge)) {
            // set the owning side to null (unless already changed)
            if ($serviceCharge->getMemberId() === $this) {
                $serviceCharge->setMemberId(null);
            }
        }

        return $this;
    }

    public function getUnionEntity(): ?Union
    {
        return $this->union_entity;
    }

    public function setUnionEntity(Union $union_entity): static
    {
        $this->union_entity = $union_entity;

        return $this;
    }
}
