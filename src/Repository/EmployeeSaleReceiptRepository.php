<?php

namespace App\Repository;

use App\Entity\EmployeeSaleReceipt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeSaleReceipt>
 *
 * @method EmployeeSaleReceipt|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeSaleReceipt|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeSaleReceipt[]    findAll()
 * @method EmployeeSaleReceipt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeSaleReceiptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeSaleReceipt::class);
    }

//    /**
//     * @return EmployeeSaleReceipt[] Returns an array of EmployeeSaleReceipt objects
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

//    public function findOneBySomeField($value): ?EmployeeSaleReceipt
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
