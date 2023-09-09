<?php

namespace App\Tests\Service\Union;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Zenstruck\Foundry\ModelFactory;

use App\Factory\{
    EmployeeFactory,
    UnionFactory
};
use App\Entity\UnionAffiliation;
use App\Service\Union\ServiceChargeTransaction;
use App\Entity\UnionServiceCharge;

class AddUnionServiceChargeTest extends KernelTestCase
{
    private \Doctrine\ORM\EntityManager $entityManager;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testTransaction(): void
    {
        $fakeEmployee = EmployeeFactory::createOne()->object();
        $fakeUnion = UnionFactory::createOne()->object();
        $unionAffiliation = new UnionAffiliation();
        $unionAffiliation->setEmployee($fakeEmployee);
        $unionAffiliation->setUnionEntity($fakeUnion);
        $unionAffiliation->setDues(ModelFactory::faker()->randomFloat());
        $this->entityManager->persist($unionAffiliation);
        
        $chargeAmount = ModelFactory::faker()->randomFloat();
        $chargeDate = new \DateTime();
        $serviceChargeTransaction = new ServiceChargeTransaction(
            $unionAffiliation->getId(), 
            $chargeDate, 
            $chargeAmount
        );
        $serviceCharge = $serviceChargeTransaction->execute($this->entityManager);
        // dump($serviceCharge);

        $serviceChargeRepository = $this->entityManager->getRepository(UnionServiceCharge::class);
        /** @var UnionServiceCharge $createdServiceCharge */
        $createdServiceCharge = $serviceChargeRepository->find($serviceCharge->getId());
        $this->assertSame($serviceCharge, $createdServiceCharge);
        $this->assertSame($unionAffiliation, $createdServiceCharge->getMemberId());
        $this->assertEquals($chargeAmount, $createdServiceCharge->getAmount());
        $this->assertEquals($chargeDate, $createdServiceCharge->getDate());
    }
}