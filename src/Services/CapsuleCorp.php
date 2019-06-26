<?php

namespace App\Services;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleCorp;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CapsuleCorp
{
    private $tokenStorage,
            $em;

    private $stockByType = [
        1 => 60,
        2 => 10,
        3 => 20,
    ];

    private $maxCapsByType = [
        1 => 8,
        2 => 1,
        3 => 3
    ];

    public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;

    }

    public function generateShop()
    {
        $shop = [];
        $shop = array_merge($shop, $this->getCapsules(3, $this->maxCapsByType[3]));
        $shop = array_merge($shop, $this->getCapsules(1, $this->maxCapsByType[1]));

        return $this->createShop($shop);
    }

    public function getCapsules(int $type, int $max)
    {
        $capsules = $this->em->getRepository(GameCapsule::class)->findBy(['type' => $type]);

        $list = [];
        for ($i = 0; $i < $max; $i++) {
            shuffle($capsules);
            $list[] = array_shift($capsules);
        }

        return $list;
    }

    private function createShop($data)
    {
        $this->resetShop();

        $timer = new \DateTime('now');
        foreach ($data as $capsule) {
            $item = new GameCapsuleCorp();
            $item->setCapsule($capsule)
                 ->setStock($this->stockByType[$capsule->getType()->getId()])
                 ->setRefreshAt($timer);

            $this->em->persist($item);
        }

        $this->em->flush();

        return true;
    }

    private function resetShop()
    {
        $connection = $this->em->getConnection();
        $dbPlatform = $connection->getDatabasePlatform();
        $connection->query('SET FOREIGN_KEY_CHECKS=0');
        $q = $dbPlatform->getTruncateTableSql('game_capsule_corp');
        $connection->executeUpdate($q);
        $connection->query('SET FOREIGN_KEY_CHECKS=1');
    }
}