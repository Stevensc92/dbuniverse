<?php

namespace App\Repository;

use App\Entity\GameUserCharacter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameUserCharacter|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameUserCharacter|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameUserCharacter[]    findAll()
 * @method GameUserCharacter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameUserCharacterRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameUserCharacter::class);
    }

    // /**
    //  * @return GameUserCharacter[] Returns an array of GameUserCharacter objects
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
    public function findOneBySomeField($value): ?GameUserCharacter
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
