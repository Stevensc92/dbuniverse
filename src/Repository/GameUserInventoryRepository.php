<?php

namespace App\Repository;

use App\Entity\GameUserInventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameUserInventory|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameUserInventory|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameUserInventory[]    findAll()
 * @method GameUserInventory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameUserInventoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameUserInventory::class);
    }

    // /**
    //  * @return GameUserInventory[] Returns an array of GameUserInventory objects
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
    public function findOneBySomeField($value): ?GameUserInventory
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
