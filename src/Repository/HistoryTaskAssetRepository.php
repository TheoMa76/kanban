<?php

namespace App\Repository;

use App\Entity\HistoryTaskAsset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<HistoryTaskAsset>
 *
 * @method HistoryTaskAsset|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoryTaskAsset|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoryTaskAsset[]    findAll()
 * @method HistoryTaskAsset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoryTaskAssetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoryTaskAsset::class);
    }

//    /**
//     * @return HistoryTaskAsset[] Returns an array of HistoryTaskAsset objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('h.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?HistoryTaskAsset
//    {
//        return $this->createQueryBuilder('h')
//            ->andWhere('h.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
