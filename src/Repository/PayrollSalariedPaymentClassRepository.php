<?php

namespace App\Repository;

use App\Entity\PayrollSalariedPaymentClass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PayrollSalariedPaymentClass>
 *
 * @method PayrollSalariedPaymentClass|null find($id, $lockMode = null, $lockVersion = null)
 * @method PayrollSalariedPaymentClass|null findOneBy(array $criteria, array $orderBy = null)
 * @method PayrollSalariedPaymentClass[]    findAll()
 * @method PayrollSalariedPaymentClass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayrollSalariedPaymentClassRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PayrollSalariedPaymentClass::class);
    }

//    /**
//     * @return PayrollSalariedPaymentClass[] Returns an array of PayrollSalariedPaymentClass objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?PayrollSalariedPaymentClass
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
