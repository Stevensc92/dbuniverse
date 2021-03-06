<?php

namespace App\Entity;

use App\Entity\GameCharacter;
use App\Repository\GameCharacterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameUserCharacterRepository")
 */
class GameUserCharacter
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
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCharacter")
     */
    private $character;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="bigint")
     */
    private $experience;

    /**
     * @ORM\Column(type="string")
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
    private $frag;

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

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameUserInventory", mappedBy="userCharacter")
     */
    private $stuff;

    public function __construct()
    {
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
        $this->updateKi();
        $this->win = 0;
        $this->loose = 0;
        $this->frag = 0;
        $this->death = 0;
        $this->draw = 0;
        $this->stuff = new ArrayCollection();
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

    public function getCharacter(): GameCharacter
    {
        return $this->character;
    }

    public function setCharacter(GameCharacter $character): self
    {
        $this->character = $character;

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

    public function getX(): ?string
    {
        return $this->x;
    }

    public function setX(string $x): self
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

    public function upPower(int $power)
    {
        if ($power < 0 || ($this->points_to_distribute - $power) < 0)
            return false;

        $this->power += $power;
        $this->points_to_distribute -= $power;

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

    public function upDefense(int $defense)
    {
        if ($defense < 0 || ($this->points_to_distribute - $defense) < 0)
            return false;

        $this->defense += $defense;
        $this->points_to_distribute -= $defense;

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

    public function upMagic(int $magic)
    {
        if ($magic < 0 || ($this->points_to_distribute - $magic) < 0)
            return false;

        $this->magic += $magic;
        $this->points_to_distribute -= $magic;

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

    public function upLuck(int $luck)
    {
        if ($luck < 0 || ($this->points_to_distribute - $luck) < 0)
            return false;

        $this->luck += $luck;
        $this->points_to_distribute -= $luck;

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

    public function upSpeed(int $speed)
    {
        if ($speed < 0 || ($this->points_to_distribute - $speed) < 0)
            return false;

        $this->speed += $speed;
        $this->points_to_distribute -= $speed;

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

    public function upConcentration(int $concentration)
    {
        if ($concentration < 0 || ($this->points_to_distribute - $concentration) < 0)
            return false;

        $this->concentration += $concentration;
        $this->points_to_distribute -= $concentration;

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

    public function upLife(int $life)
    {
        if ($life < 0 || ($this->points_to_distribute - ($life / 100)) < 0)
            return false;

        /** 1 point for 100 */
        $this->life += $life;
        $this->points_to_distribute -= ($life / 100);

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

    public function upEnergy(int $energy)
    {
        if ($energy < 0 || ($this->points_to_distribute - ($energy / 5)) < 0)
            return false;

        /** 1 point for 5 */
        $this->energy += $energy;
        $this->points_to_distribute -= ($energy / 5);

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

    public function updateKi()
    {
        /**
         *  force : 1 = 500
            defense : 1 = 250
            magie : 1 = 200
            chance : 1 = 0
            vitesse : 1 = 100
            concentration : 1 = 100
         */
        $ki =
            ($this->power * 500) +
            ($this->defense * 250) +
            ($this->magic * 200) +
            ($this->luck * 0) +
            ($this->speed * 100) +
            ($this->concentration * 100);

        return $this->setKi($ki);
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

    public function getFrag(): ?int
    {
        return $this->frag;
    }

    public function setFrag(int $frag): self
    {
        $this->frag = $frag;

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

    public function downPointsToDistribute(int $points_to_distribute)
    {
        $this->points_to_distribute -= $points_to_distribute;

        return $this;
    }

    /**
     * @return Collection|GameUserInventory[]
     */
    public function getStuff(): Collection
    {
        return $this->stuff;
    }

    public function addStuff(GameUserInventory $stuff): self
    {
        if (!$this->stuff->contains($stuff)) {
            $this->stuff[] = $stuff;
            $stuff->setUserCharacter($this);
        }

        return $this;
    }

    public function removeStuff(GameUserInventory $stuff): self
    {
        if ($this->stuff->contains($stuff)) {
            $this->stuff->removeElement($stuff);
            // set the owning side to null (unless already changed)
            if ($stuff->getUserCharacter() === $this) {
                $stuff->setUserCharacter(null);
            }
        }

        return $this;
    }
}
