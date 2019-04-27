<?php

namespace App\Services;

use App\Entity\GameCharacterAvatar;
use Doctrine\ORM\EntityManager;
use App\Entity\GameCharacter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class Character
{
    private $em;

    private $tokenStorage;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    public function getCurrentCharacter()
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $idCurrentCharacter = $user->getGameUser()->getCurrentCharacter();

        $currentCharacter = $this->em->getRepository('App:GameCharacter')->findOneBy(['id' => $idCurrentCharacter]);

        $character = $this->em->getRepository('App:GameUserCharacter')
                    ->findCurrentCharacter($user, $currentCharacter)
        ;

        return $character;
    }

    public function getAvatar()
    {
        $currentCharacter = $this->getCurrentCharacter();

        $avatarRepo = $this->em->getRepository('App:GameCharacterAvatar');

        /** @var GameCharacterAvatar $avatar */
        $avatar = $avatarRepo->findOneBy([
            'character_id' => $currentCharacter->getCharacter()->getId(),
            'level' => $currentCharacter->getLevel()
        ]);

        return $currentCharacter->getCharacter()->getSlug().'/'.$avatar->getImage();
    }
}