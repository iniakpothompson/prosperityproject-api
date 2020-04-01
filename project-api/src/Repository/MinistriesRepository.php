<?php

namespace App\Repository;

use App\Entity\Ministries;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ministries|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ministries|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ministries[]    findAll()
 * @method Ministries[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinistriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ministries::class);
    }

    // /**
    //  * @return Ministries[] Returns an array of Ministries objects
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
    public function findOneBySomeField($value): ?Ministries
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
