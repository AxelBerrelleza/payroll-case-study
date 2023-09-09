<?php

namespace App\Repository;

use App\Entity\UnionServiceCharge;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UnionServiceCharge>
 *
 * @method UnionServiceCharge|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnionServiceCharge|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnionServiceCharge[]    findAll()
 * @method UnionServiceCharge[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnionServiceChargeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnionServiceCharge::class);
    }

//    /**
//     * @return UnionServiceCharge[] Returns an array of UnionServiceCharge objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UnionServiceCharge
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
