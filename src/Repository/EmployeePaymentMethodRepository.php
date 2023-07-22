<?php

namespace App\Repository;

use App\Entity\EmployeePaymentMethod;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeePaymentMethod>
 *
 * @method EmployeePaymentMethod|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeePaymentMethod|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeePaymentMethod[]    findAll()
 * @method EmployeePaymentMethod[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeePaymentMethodRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeePaymentMethod::class);
    }

//    /**
//     * @return EmployeePaymentMethod[] Returns an array of EmployeePaymentMethod objects
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

//    public function findOneBySomeField($value): ?EmployeePaymentMethod
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
