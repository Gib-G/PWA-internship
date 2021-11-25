<?php

namespace App\Repository;

use App\Entity\RedirectionProduit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RedirectionProduit|null find($id, $lockMode = null, $lockVersion = null)
 * @method RedirectionProduit|null findOneBy(array $criteria, array $orderBy = null)
 * @method RedirectionProduit[]    findAll()
 * @method RedirectionProduit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RedirectionProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RedirectionProduit::class);
    }

    // /**
    //  * @return RedirectionProduit[] Returns an array of RedirectionProduit objects
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
    public function findOneBySomeField($value): ?RedirectionProduit
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
