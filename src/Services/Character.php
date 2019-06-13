<?php

namespace App\Services;

use App\Entity\GameCharacterAvatar;
use App\Entity\GameUser;
use App\Entity\GameUserCharacter;
use App\Repository\GameLevelRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\GameCharacter;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Character
{
    private $em;

    private $tokenStorage;

    public function __construct(EntityManagerInterface $em, TokenStorageInterface $tokenStorage)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return GameUserCharacter
     */
    public function getCurrentCharacter()
    {
        $user               = $this->tokenStorage->getToken()->getUser();
        $idCurrentCharacter = $user->getGameUser()->getCurrentCharacter();
        $currentCharacter   = $this->em->getRepository('App:GameCharacter')->findOneBy(['id' => $idCurrentCharacter]);

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
        $currentCharacter   = $this->getCurrentCharacter();

        $avatarRepo         = $this->em->getRepository('App:GameCharacterAvatar');

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
        $CC             = $this->getCurrentCharacter();
        $experience     = $CC->getExperience();
        $level          = $CC->getLevel();

        /** @var GameLevelRepository $gameLevelRepo */
        $gameLevelRepo  = $this->em->getRepository('App:GameLevel');

        if ($level === 1) {
            $level += 1;

            $expRequired    = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();
            $percent        = ceil( ($experience * 100) / $expRequired);
        } else if ($level < 100) {
            $expRequiredCurrentLevel = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();
            $level += 1;
            $expRequiredNextLevel    = $gameLevelRepo->findOneBy(['level' => $level])->getExperienceRequired();

            $expRequired = $expRequiredNextLevel - $expRequiredCurrentLevel;
            $experience -= $expRequiredCurrentLevel;
            $percent     = ceil( ($experience * 100) / $expRequired );
        } else {
            $percent = 0;
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
        $user           = $this->tokenStorage->getToken()->getUser();

        $gameUserRepo   = $this->em->getRepository('App:GameUser');

        /** @var GameUser $gameUser */
        $gameUser       = $gameUserRepo->find($user);

        return $gameUser->getZenis();
    }

    public function getDamageInFight($where = 'page-character')
    {
        $CC         = $this->getCurrentCharacter();
        
        $power      = $CC->getPower();
        $defense    = $CC->getDefense();
        $magic      = $CC->getMagic();

        $levelPow   = 1 + ($CC->getLevel() / 10);

        $damageMax  = ($power > 0) ? ceil( ceil(exp(2)) * pow($power, 0.85)) : 0;
        $damageMax  = ceil($damageMax * $levelPow);
        $damageMin  = ($power > 0) ? ceil($damageMax * 0.65) : 0;

        $defenseMax = ($defense > 0) ? ceil( ceil(exp(2)) * pow($defense, 0.756)) : 0;
        $defenseMax = ceil($defenseMax * $levelPow);
        $defenseMin = ($defense > 0) ? ceil($defenseMax * 0.40) : 0;

        $magicMax   = ($magic > 0) ? ceil( ceil(exp(2.85)) * pow($magic, 0.75)) : 0;
        $magicMax   = ceil($magicMax * $levelPow);
        $magicMin   = ($magic > 0) ? ceil($magicMax * 0.65) : 0;

        if ($where === 'fight') {
            $array = [
                'degat_max' => $damageMax,
                'degat_min' => $damageMin,
                'def_max'   => $defenseMax,
                'def_min'   => $defenseMin,
                'magie_max' => $magicMax,
                'magie_min' => $magicMin,
            ];
        } else {
            $array = [
                'Dégâts max'    => $damageMax,
                'Dégâts min'    => $damageMin,
                'Défense max'   => $defenseMax,
                'Défense min'   => $defenseMin,
                'Magie max'     => $magicMax,
                'Magie min'     => $magicMin,
            ];
        }

        return $array;
    }

    public function getExpToUp()
    {
        $CC             = $this->getCurrentCharacter();
        $experience     = $CC->getExperience();
        $user           = $this->tokenStorage->getToken()->getUser();

        $gameLevelRepo  = $this->em->getRepository('App:GameLevel');
        $expRequired    = $gameLevelRepo->findOneBy(['level' => ($CC->getLevel())+1]);

        if ($expRequired !== null) {
            $expToGo = $expRequired->getExperienceRequired() - $experience;
        } else {
            $expToGo = $gameLevelRepo->findOneBy([], ['id' => 'DESC'])->getExperienceRequired();
        }

        return $expToGo;
    }

    public function getListCharacterForUser()
    {
        $gameUserCharacterRepository = $this->em->getRepository('App:GameUserCharacter');

        $userCharacters = $gameUserCharacterRepository->findBy(['user' => $this->tokenStorage->getToken()->getUser()]);

        return $userCharacters;
    }

    public function getPositionMap()
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $GUC = $this->em->getRepository('App:GameUserCharacter');

        $currentChar = $this->getCurrentCharacter();

        $position = $GUC->getPosition($user, $currentChar->getCharacter());

        return $position;
    }

    public function getCharactersInXAndY($x, $y)
    {
        $user = $this->tokenStorage->getToken()->getUser();

        $GUC = $this->em->getRepository('App:GameUserCharacter');

        $characters = $GUC->getCharactersInXAndY($x, $y, $user);

        return $characters;
    }

    public function getActionMap($x, $y)
    {
        $GMA = $this->em->getRepository('App:GameMapAction');

        $actions = $GMA->findBy(['x' => $x, 'y' => $y]);

        return $actions;
    }

    public function hasActionMapInPos($x, $y)
    {
        return ($this->getActionMap($x, $y)) ? true : false;
    }
}