<?php

namespace App\Repository;

use App\Entity\Authen;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Authen|null find($id, $lockMode = null, $lockVersion = null)
 * @method Authen|null findOneBy(array $criteria, array $orderBy = null)
 * @method Authen[]    findAll()
 * @method Authen[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AuthenRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Authen::class);
    }

    // /**
    //  * @return Authen[] Returns an array of Authen objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Authen
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
