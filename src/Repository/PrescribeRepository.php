<?php

namespace App\Repository;

use App\Entity\Prescribe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Prescribe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Prescribe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Prescribe[]    findAll()
 * @method Prescribe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrescribeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prescribe::class);
    }

    // /**
    //  * @return Prescribe[] Returns an array of Prescribe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Prescribe
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
