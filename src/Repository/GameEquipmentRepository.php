<?php

namespace App\Repository;

use App\Entity\GameEquipment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameEquipment|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameEquipment|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameEquipment[]    findAll()
 * @method GameEquipment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameEquipmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameEquipment::class);
    }

    // /**
    //  * @return GameEquipment[] Returns an array of GameEquipment objects
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
    public function findOneBySomeField($value): ?GameEquipment
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
