<?php

namespace App\Repository;

use App\Entity\GameCapsuleType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameCapsuleType|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCapsuleType|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCapsuleType[]    findAll()
 * @method GameCapsuleType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCapsuleTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameCapsuleType::class);
    }

    // /**
    //  * @return GameCapsuleType[] Returns an array of GameCapsuleType objects
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
    public function findOneBySomeField($value): ?GameCapsuleType
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
