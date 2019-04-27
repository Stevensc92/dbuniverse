<?php

namespace App\Repository;

use App\Entity\GameCharacterAvatar;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameCharacterAvatar|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameCharacterAvatar|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameCharacterAvatar[]    findAll()
 * @method GameCharacterAvatar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameCharacterAvatarRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameCharacterAvatar::class);
    }

    // /**
    //  * @return GameCharacterAvatar[] Returns an array of GameCharacterAvatar objects
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
    public function findOneBySomeField($value): ?GameCharacterAvatar
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
