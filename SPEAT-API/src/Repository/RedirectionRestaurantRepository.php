<?php

namespace App\Repository;

use App\Entity\RedirectionRestaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RedirectionRestaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method RedirectionRestaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method RedirectionRestaurant[]    findAll()
 * @method RedirectionRestaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedirectionRestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RedirectionRestaurant::class);
    }

    // /**
    //  * @return RedirectionRestaurant[] Returns an array of RedirectionRestaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RedirectionRestaurant
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
