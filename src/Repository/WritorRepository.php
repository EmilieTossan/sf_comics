<?php

namespace App\Repository;

use App\Entity\Writor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Writor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Writor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Writor[]    findAll()
 * @method Writor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WritorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Writor::class);
    }

    // /**
    //  * @return Writor[] Returns an array of Writor objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Writor
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
