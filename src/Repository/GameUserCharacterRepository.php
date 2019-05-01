<?php

namespace App\Repository;

use App\Entity\GameUserCharacter;
use App\Entity\User;
use App\Entity\GameCharacter;
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

    /**
     * @param User $user
     * @param GameCharacter $character
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findCurrentCharacter(User $user, GameCharacter $character)
    {
        return $this->createQueryBuilder('game_user_character')
                ->where('game_user_character.user = :user')
                ->andWhere('game_user_character.character = :character')
                ->setParameter('user', $user)
                ->setParameter('character', $character)
                ->getQuery()
                ->getOneOrNullResult();
    }

    public function getExpRequired($level)
    {
        $qb = $this->createQueryBuilder('game_user_character')
            ->select('game_level.exp_required')
            ->leftJoin('game_level', 'game_level', 'ON', 'game_user.level = :level')
            ->setParameter('level', $level)
            ->getQuery()
            ->getOneOrNullResult();

        return $qb;
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
