<?php

namespace App\Repository;

use App\Entity\GameLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameLevel[]    findAll()
 * @method GameLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameLevelRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameLevel::class);
    }

    // /**
    //  * @return GameLevel[] Returns an array of GameLevel objects
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
    public function findOneBySomeField($value): ?GameLevel
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
