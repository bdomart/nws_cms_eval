<?php

namespace App\Repository;

use App\Entity\FoodComposition;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FoodComposition|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodComposition|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodComposition[]    findAll()
 * @method FoodComposition[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodCompositionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodComposition::class);
    }

    // /**
    //  * @return FoodComposition[] Returns an array of FoodComposition objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FoodComposition
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
