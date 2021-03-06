<?php

namespace App\Repository;

use App\Entity\GameCapsule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameCapsule|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCapsule|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCapsule[]    findAll()
 * @method GameCapsule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCapsuleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameCapsule::class);
    }

    // /**
    //  * @return GameCapsule[] Returns an array of GameCapsule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GameCapsule
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
