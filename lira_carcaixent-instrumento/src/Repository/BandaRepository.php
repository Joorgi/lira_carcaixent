<?php

namespace App\Repository;

use App\Entity\Banda;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Banda|null find($id, $lockMode = null, $lockVersion = null)
 * @method Banda|null findOneBy(array $criteria, array $orderBy = null)
 * @method Banda[]    findAll()
 * @method Banda[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BandaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Banda::class);
    }

    // /**
    //  * @return Banda[] Returns an array of Banda objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Banda
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
