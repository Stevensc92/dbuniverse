<?php

namespace App\Repository;

use App\Entity\MapAction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MapAction|null find($id, $lockMode = null, $lockVersion = null)
 * @method MapAction|null findOneBy(array $criteria, array $orderBy = null)
 * @method MapAction[]    findAll()
 * @method MapAction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameMapActionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MapAction::class);
    }

    // /**
    //  * @return MapAction[] Returns an array of MapAction objects
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
    public function findOneBySomeField($value): ?MapAction
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
