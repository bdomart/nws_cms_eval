<?php

namespace App\Repository;

use App\Entity\FoodComponent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method FoodComponent|null find($id, $lockMode = null, $lockVersion = null)
 * @method FoodComponent|null findOneBy(array $criteria, array $orderBy = null)
 * @method FoodComponent[]    findAll()
 * @method FoodComponent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FoodComponentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FoodComponent::class);
    }

    // /**
    //  * @return FoodComponent[] Returns an array of FoodComponent objects
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
    public function findOneBySomeField($value): ?FoodComponent
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
