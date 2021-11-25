<?php

namespace App\Repository;

use App\Entity\TypePublicite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypePublicite|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypePublicite|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypePublicite[]    findAll()
 * @method TypePublicite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypePubliciteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypePublicite::class);
    }

    // /**
    //  * @return TypePublicite[] Returns an array of TypePublicite objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypePublicite
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
