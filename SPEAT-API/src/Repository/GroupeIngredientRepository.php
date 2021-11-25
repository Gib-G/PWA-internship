<?php

namespace App\Repository;

use App\Entity\GroupeIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupeIngredient|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupeIngredient|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupeIngredient[]    findAll()
 * @method GroupeIngredient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupeIngredientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupeIngredient::class);
    }

    // /**
    //  * @return GroupeIngredient[] Returns an array of GroupeIngredient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupeIngredient
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
