<?php

namespace App\Repository;

use App\Entity\Instrumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Instrumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instrumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instrumento[]    findAll()
 * @method Instrumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstrumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Instrumento::class);
    }

    // /**
    //  * @return Instrumento[] Returns an array of Instrumento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instrumento
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
