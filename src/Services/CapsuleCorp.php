<?php

namespace App\Services;

use App\Entity\GameCapsule;
use App\Entity\GameCapsuleCorp;
use App\Entity\GameUser;
use App\Entity\GameUserInventory;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use http\Env\Response;
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

    /**
     * FONCTIONS TO BUY A CAPSULE
     */

    /**
     * @param GameCapsule $capsule
     * @param GameUser $gameUser
     * @param GameCapsuleCorp $capsuleInShop
     * @return string|boolean
     */
    public function checkBuyCapsule(GameCapsule $capsule, GameUser $gameUser, GameCapsuleCorp $capsuleInShop)
    {
        if ($gameUser->getZenis() - $capsule->getPrice() <= 0) {
            $response = "Vous n'avez pas assez d'argent pour acheter cette capsule.";
        } else if ($capsuleInShop->getStock() <= 0) {
            $response = "Cette capsule est en rupture de stock.";
        } else {
            return true;
        }

        return $response;
    }

    /**
     * @param GameCapsule $capsule
     * @return string|boolean
     */
    public function buyCapsule(gameCapsule $capsule)
    {
        /** @var User $user */
        $user           = $this->tokenStorage->getToken()->getUser();
        /** @var GameUser $gameUser */
        $gameUser       = $user->getGameUser();
        /** @var GameCapsuleCorp $capsuleInShop */
        $capsuleInShop  = $this->em->getRepository(GameCapsuleCorp::class)->findOneBy(['capsule' => $capsule]);

        if ($capsuleInShop) {

            if ($checkIn = $this->checkBuyCapsule($capsule, $gameUser, $capsuleInShop)) {
                $capsuleInShop->setStock($capsuleInShop->getStock() - 1);

                $inventory = new GameUserInventory();
                $inventory->setUser($gameUser)
                    ->setCapsule($capsule);

                $this->em->persist($inventory);
                $gameUser->addInventory($inventory)
                         ->updateZenis($capsule->getPrice());

                $this->em->flush();

                return true;
            } else {
                return $checkIn;
            }
        } else {
            return "Erreur de requête.";
        }
    }
}