<?php

namespace App\Repository;

use App\Entity\GameListCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameListCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameListCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameListCharacter[]    findAll()
 * @method GameListCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameListCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameListCharacter::class);
    }

    // /**
    //  * @return GameListCharacter[] Returns an array of GameListCharacter objects
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
    public function findOneBySomeField($value): ?GameListCharacter
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
