<?php

namespace App\Repository;

use App\Entity\EmployeeTimeCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EmployeeTimeCard>
 *
 * @method EmployeeTimeCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method EmployeeTimeCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method EmployeeTimeCard[]    findAll()
 * @method EmployeeTimeCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EmployeeTimeCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EmployeeTimeCard::class);
    }

//    /**
//     * @return EmployeeTimeCard[] Returns an array of EmployeeTimeCard objects
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

//    public function findOneBySomeField($value): ?EmployeeTimeCard
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
