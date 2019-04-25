<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameListUserCharacterRepository")
 */
class GameListUserCharacter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $character_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="bigint")
     */
    private $experience;

    /**
     * @ORM\Column(type="integer")
     */
    private $x;

    /**
     * @ORM\Column(type="integer")
     */
    private $y;

    /**
     * @ORM\Column(type="integer")
     */
    private $power;

    /**
     * @ORM\Column(type="integer")
     */
    private $defense;

    /**
     * @ORM\Column(type="integer")
     */
    private $magic;

    /**
     * @ORM\Column(type="integer")
     */
    private $luck;

    /**
     * @ORM\Column(type="integer")
     */
    private $speed;

    /**
     * @ORM\Column(type="integer")
     */
    private $concentration;

    /**
     * @ORM\Column(type="integer")
     */
    private $life;

    /**
     * @ORM\Column(type="integer")
     */
    private $energy;

    /**
     * @ORM\Column(type="bigint")
     */
    private $ki;

    /**
     * @ORM\Column(type="integer")
     */
    private $win;

    /**
     * @ORM\Column(type="integer")
     */
    private $loose;

    /**
     * @ORM\Column(type="integer")
     */
    private $killed;

    /**
     * @ORM\Column(type="integer")
     */
    private $death;

    /**
     * @ORM\Column(type="integer")
     */
    private $draw;

    /**
     * @ORM\Column(type="integer")
     */
    private $points_to_distribute;

    public function __construct()
    {
        $this->character_id = 1;
        $this->level = 1;
        $this->experience = 0;
        $this->points_to_distribute = 6;
        $this->x = 7;
        $this->y = 6;
        $this->power = 10;
        $this->defense = 10;
        $this->magic = 10;
        $this->luck = 10;
        $this->speed = 10;
        $this->concentration = 10;
        $this->life = 1000;
        $this->energy = 500;
        $this->ki = 1150;
        $this->win = 0;
        $this->loose = 0;
        $this->killed = 0;
        $this->death = 0;
        $this->draw = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCharacterId(): ?int
    {
        return $this->character_id;
    }

    public function setCharacterId(int $character_id): self
    {
        $this->character_id = $character_id;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getX(): ?int
    {
        return $this->x;
    }

    public function setX(int $x): self
    {
        $this->x = $x;

        return $this;
    }

    public function getY(): ?int
    {
        return $this->y;
    }

    public function setY(int $y): self
    {
        $this->y = $y;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getMagic(): ?int
    {
        return $this->magic;
    }

    public function setMagic(int $magic): self
    {
        $this->magic = $magic;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getConcentration(): ?int
    {
        return $this->concentration;
    }

    public function setConcentration(int $concentration): self
    {
        $this->concentration = $concentration;

        return $this;
    }

    public function getLife(): ?int
    {
        return $this->life;
    }

    public function setLife(int $life): self
    {
        $this->life = $life;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(int $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getKi(): ?int
    {
        return $this->ki;
    }

    public function setKi(int $ki): self
    {
        $this->ki = $ki;

        return $this;
    }

    public function getWin(): ?int
    {
        return $this->win;
    }

    public function setWin(int $win): self
    {
        $this->win = $win;

        return $this;
    }

    public function getLoose(): ?int
    {
        return $this->loose;
    }

    public function setLoose(int $loose): self
    {
        $this->loose = $loose;

        return $this;
    }

    public function getKilled(): ?int
    {
        return $this->killed;
    }

    public function setKilled(int $killed): self
    {
        $this->killed = $killed;

        return $this;
    }

    public function getDeath(): ?int
    {
        return $this->death;
    }

    public function setDeath(int $death): self
    {
        $this->death = $death;

        return $this;
    }

    public function getDraw(): ?int
    {
        return $this->draw;
    }

    public function setDraw(int $draw): self
    {
        $this->draw = $draw;

        return $this;
    }

    public function getPointsToDistribute(): ?int
    {
        return $this->points_to_distribute;
    }

    public function setPointsToDistribute(int $points_to_distribute): self
    {
        $this->points_to_distribute = $points_to_distribute;

        return $this;
    }
}
