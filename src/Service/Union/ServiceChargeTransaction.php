<?php

namespace App\Service\Union;

use Doctrine\ORM\EntityManagerInterface;
use App\Utils\Interfaces\EntityTransaction;
use App\Entity\{
    UnionServiceCharge,
    UnionAffiliation
};
use App\Repository\UnionAffiliationRepository;

class ServiceChargeTransaction implements EntityTransaction
{
    public function __construct(
        protected readonly int $memberId, 
        protected readonly \DateTime $date,
        protected readonly float $amount
    ) {
    }

    public function execute(EntityManagerInterface $entityManager)
    {
        $serviceCharge = new UnionServiceCharge();
        /** @var UnionAffiliationRepository $affiliationRepository */
        $affiliationRepository = $entityManager->getRepository(UnionAffiliation::class);
        $affiliation = $affiliationRepository->find($this->memberId);
        $serviceCharge->setMemberId($affiliation);
        $serviceCharge->setDate(\DateTimeImmutable::createFromMutable($this->date));
        $serviceCharge->setAmount($this->amount);

        $entityManager->persist($serviceCharge);
        $entityManager->flush();

        return $serviceCharge;
    }
}