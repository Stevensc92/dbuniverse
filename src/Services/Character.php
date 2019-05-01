<?php

namespace App\Services;

use App\Entity\GameCharacterAvatar;
use App\Entity\GameUser;
use App\Entity\GameUserCharacter;
use App\Repository\GameLevelRepository;
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

    /**
     * @return GameUserCharacter
     */
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

    /**
     * @return string link to avatar
     */
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

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getCurrentCharacter()->getCharacter()->getName();
    }

    public function getPercentExp()
    {
        $CC = $this->getCurrentCharacter();
        $experience = $CC->getExperience();
        $level = $CC->getLevel();

        /** @var GameLevelRepository $gameLevelRepo */
        $gameLevelRepo = $this->em->getRepository('App:GameLevel');

        if ($level === 1) {
            $level += 1;

            $expRequired = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();
            $percent = ceil( ($experience * 100) / $expRequired);
        } else {
            $expRequiredCurrentLevel = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();
            $level += 1;
            $expRequiredNextLevel = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();

            $expRequired = $expRequiredNextLevel - $expRequiredCurrentLevel;
            $experience -= $expRequiredCurrentLevel;
            $percent = ceil( ($experience * 100) / $expRequired );
        }

        if ($percent > 100) {
            $percent = 100;
        } elseif ($percent < 0) {
            $percent = 0;
        }

        return $percent;
    }

    public function getZenis()
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $gameUserRepo = $this->em->getRepository('App:GameUser');

        /** @var GameUser $gameUser */
        $gameUser = $gameUserRepo->find($user);

        return $gameUser->getZenis();
    }
}