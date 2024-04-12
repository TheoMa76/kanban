<?php

namespace App\Repository;

use App\Entity\UserHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserHistory>
 *
 * @method UserHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserHistory[]    findAll()
 * @method UserHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserHistoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserHistory::class);
    }

    //    /**
    //     * @return UserHistory[] Returns an array of UserHistory objects
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

    //    public function findOneBySomeField($value): ?UserHistory
    //    {
    //        return $this->createQueryBuilder('u')
    //            ->andWhere('u.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
