<?php

namespace App\Repository;

use App\Entity\TaskAssetType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TaskAssetType>
 *
 * @method TaskAssetType|null find($id, $lockMode = null, $lockVersion = null)
 * @method TaskAssetType|null findOneBy(array $criteria, array $orderBy = null)
 * @method TaskAssetType[]    findAll()
 * @method TaskAssetType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskAssetTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TaskAssetType::class);
    }

    //    /**
    //     * @return TaskAssetType[] Returns an array of TaskAssetType objects
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

    //    public function findOneBySomeField($value): ?TaskAssetType
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
