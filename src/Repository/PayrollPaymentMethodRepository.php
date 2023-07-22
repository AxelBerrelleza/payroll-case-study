<?php

namespace App\Repository;

use App\Entity\PayrollPaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<PayrollPaymentMethod>
 *
 * @method PayrollPaymentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method PayrollPaymentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method PayrollPaymentMethod[]    findAll()
 * @method PayrollPaymentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PayrollPaymentMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PayrollPaymentMethod::class);
    }

//    /**
//     * @return PayrollPaymentMethod[] Returns an array of PayrollPaymentMethod objects
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

//    public function findOneBySomeField($value): ?PayrollPaymentMethod
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
