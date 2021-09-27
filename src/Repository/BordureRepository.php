<?php

namespace App\Repository;

use App\Entity\Bordure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Bordure|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bordure|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bordure[]    findAll()
 * @method Bordure[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BordureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bordure::class);
    }

    // /**
    //  * @return Bordure[] Returns an array of Bordure objects
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
    public function findOneBySomeField($value): ?Bordure
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
