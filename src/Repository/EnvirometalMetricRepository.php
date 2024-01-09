<?php

namespace App\Repository;

use App\Entity\EnvirometalMetric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EnvirometalMetric>
 *
 * @method EnvirometalMetric|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnvirometalMetric|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnvirometalMetric[]    findAll()
 * @method EnvirometalMetric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvirometalMetricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnvirometalMetric::class);
    }

//    /**
//     * @return EnvirometalMetric[] Returns an array of EnvirometalMetric objects
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

//    public function findOneBySomeField($value): ?EnvirometalMetric
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
