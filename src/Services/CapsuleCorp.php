<?php

namespace App\Services;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class CapsuleCorp
{
    private $tokenStorage,
            $em;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;

        dump($this->em);
    }
}