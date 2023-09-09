<?php

namespace App\Repository;

use App\Entity\UnionAffiliation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UnionAffiliation>
 *
 * @method UnionAffiliation|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnionAffiliation|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnionAffiliation[]    findAll()
 * @method UnionAffiliation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnionAffiliationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnionAffiliation::class);
    }

//    /**
//     * @return UnionAffiliation[] Returns an array of UnionAffiliation objects
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

//    public function findOneBySomeField($value): ?UnionAffiliation
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
