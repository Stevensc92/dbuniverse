<?php

namespace App\Repository;

use App\Entity\GameCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCharacter[]    findAll()
 * @method GameCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameCharacter::class);
    }

    // /**
    //  * @return GameCharacter[] Returns an array of GameCharacter objects
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
    public function findOneBySomeField($value): ?GameCharacter
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
