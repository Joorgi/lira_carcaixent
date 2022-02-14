<?php

namespace App\Repository;

use App\Entity\Musico;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Musico|null find($id, $lockMode = null, $lockVersion = null)
 * @method Musico|null findOneBy(array $criteria, array $orderBy = null)
 * @method Musico[]    findAll()
 * @method Musico[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MusicoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Musico::class);
    }

    // /**
    //  * @return Musico[] Returns an array of Musico objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Musico
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
