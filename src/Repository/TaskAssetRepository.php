<?php

namespace App\Repository;

use App\Entity\TaskAsset;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaskAsset>
 *
 * @method TaskAsset|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskAsset|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskAsset[]    findAll()
 * @method TaskAsset[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskAssetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskAsset::class);
    }

//    /**
//     * @return TaskAsset[] Returns an array of TaskAsset objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TaskAsset
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
