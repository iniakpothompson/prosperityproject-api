<?php

namespace App\Repository;

use App\Entity\ReceiptfileDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ReceiptfileDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReceiptfileDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReceiptfileDetails[]    findAll()
 * @method ReceiptfileDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReceiptfileDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReceiptfileDetails::class);
    }

    // /**
    //  * @return ReceiptfileDetails[] Returns an array of ReceiptfileDetails objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ReceiptfileDetails
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
