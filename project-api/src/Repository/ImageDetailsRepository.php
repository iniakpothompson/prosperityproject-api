<?php

namespace App\Repository;

use App\Entity\ImageDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ImageDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageDetails[]    findAll()
 * @method ImageDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageDetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImageDetails::class);
    }

    // /**
    //  * @return ImageDetails[] Returns an array of ImageDetails objects
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
    public function findOneBySomeField($value): ?ImageDetails
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
