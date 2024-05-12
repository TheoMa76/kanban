<?php

namespace App\Repository;

use App\Entity\ListOfTodo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ListOfTodo>
 *
 * @method ListOfTodo|null find($id, $lockMode = null, $lockVersion = null)
 * @method ListOfTodo|null findOneBy(array $criteria, array $orderBy = null)
 * @method ListOfTodo[]    findAll()
 * @method ListOfTodo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ListOfTodoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ListOfTodo::class);
    }

    //    /**
    //     * @return ListOfTodo[] Returns an array of ListOfTodo objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ListOfTodo
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
