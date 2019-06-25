<?php

namespace App\Repository;

use App\Entity\GameCapsuleCorp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameCapsuleCorp|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCapsuleCorp|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCapsuleCorp[]    findAll()
 * @method GameCapsuleCorp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCapsuleCorpRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameCapsuleCorp::class);
    }

    // /**
    //  * @return GameCapsuleCorp[] Returns an array of GameCapsuleCorp objects
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
    public function findOneBySomeField($value): ?GameCapsuleCorp
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
