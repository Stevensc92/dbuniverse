<?php

namespace App\Services;

use App\Entity\GameCapsule;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CapsuleCorp
{
    private $tokenStorage,
            $em;

    public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;

    }

    public function generateShop()
    {
        $shop = [];
        $shop = array_merge($shop, $this->getCapsules(1, 10));
        $shop = array_merge($shop, $this->getCapsules(3, 3));

       return $shop;
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
}