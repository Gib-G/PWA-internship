<?php

namespace App\Repository;

use App\Entity\EnregistrementRestaurant;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnregistrementRestaurant|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnregistrementRestaurant|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnregistrementRestaurant[]    findAll()
 * @method EnregistrementRestaurant[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnregistrementRestaurantRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnregistrementRestaurant::class);
    }

    // /**
    //  * @return EnregistrementRestaurant[] Returns an array of EnregistrementRestaurant objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EnregistrementRestaurant
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
