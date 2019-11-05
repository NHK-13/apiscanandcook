<?php

namespace App\Repository;

use App\Entity\TimeRecette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TimeRecette|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeRecette|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeRecette[]    findAll()
 * @method TimeRecette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeRecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeRecette::class);
    }

    // /**
    //  * @return TimeRecette[] Returns an array of TimeRecette objects
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
    public function findOneBySomeField($value): ?TimeRecette
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
