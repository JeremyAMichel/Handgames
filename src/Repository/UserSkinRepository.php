<?php

namespace App\Repository;

use App\Entity\UserSkin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UserSkin|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserSkin|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserSkin[]    findAll()
 * @method UserSkin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserSkinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSkin::class);
    }

    // /**
    //  * @return UserSkin[] Returns an array of UserSkin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserSkin
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
