<?php

namespace App\Repository;

use App\Entity\GameEquipmentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GameEquipmentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameEquipmentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameEquipmentType[]    findAll()
 * @method GameEquipmentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameEquipmentTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GameEquipmentType::class);
    }

    // /**
    //  * @return GameEquipmentType[] Returns an array of GameEquipmentType objects
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
    public function findOneBySomeField($value): ?GameEquipmentType
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
