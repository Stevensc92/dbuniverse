<?php

namespace App\Repository;

use App\Entity\GameListUserCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameListUserCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameListUserCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameListUserCharacter[]    findAll()
 * @method GameListUserCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameListUserCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameListUserCharacter::class);
    }

    // /**
    //  * @return GameListUserCharacter[] Returns an array of GameListUserCharacter objects
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
    public function findOneBySomeField($value): ?GameListUserCharacter
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
