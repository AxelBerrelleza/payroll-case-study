<?php

namespace App\Repository;

use App\Entity\EmployeePaymentClassification;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeePaymentClassification>
 *
 * @method EmployeePaymentClassification|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeePaymentClassification|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeePaymentClassification[]    findAll()
 * @method EmployeePaymentClassification[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeePaymentClassificationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeePaymentClassification::class);
    }

//    /**
//     * @return EmployeePaymentClassification[] Returns an array of EmployeePaymentClassification objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EmployeePaymentClassification
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
