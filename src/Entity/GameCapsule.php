<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameCapsuleRepository")
 */
class GameCapsule
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCapsuleType", inversedBy="gameCapsules")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCharacter")
     */
    private $character;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $damage;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $power;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $defense;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $magic;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $luck;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speed;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $concentration;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $life;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $energy;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?GameCapsuleType
    {
        return $this->type;
    }

    public function setType(?GameCapsuleType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getCharacter(): ?GameCharacter
    {
        return $this->character;
    }

    public function setCharacter(?GameCharacter $character): self
    {
        $this->character = $character;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getDamage(): ?float
    {
        return $this->damage;
    }

    public function setDamage(?float $damage): self
    {
        $this->damage = $damage;

        return $this;
    }

    public function getPower(): ?int
    {
        return $this->power;
    }

    public function setPower(?int $power): self
    {
        $this->power = $power;

        return $this;
    }

    public function getDefense(): ?int
    {
        return $this->defense;
    }

    public function setDefense(?int $defense): self
    {
        $this->defense = $defense;

        return $this;
    }

    public function getMagic(): ?int
    {
        return $this->magic;
    }

    public function setMagic(?int $magic): self
    {
        $this->magic = $magic;

        return $this;
    }

    public function getLuck(): ?int
    {
        return $this->luck;
    }

    public function setLuck(?int $luck): self
    {
        $this->luck = $luck;

        return $this;
    }

    public function getSpeed(): ?int
    {
        return $this->speed;
    }

    public function setSpeed(?int $speed): self
    {
        $this->speed = $speed;

        return $this;
    }

    public function getConcentration(): ?int
    {
        return $this->concentration;
    }

    public function setConcentration(?int $concentration): self
    {
        $this->concentration = $concentration;

        return $this;
    }

    public function getLife(): ?int
    {
        return $this->life;
    }

    public function setLife(?int $life): self
    {
        $this->life = $life;

        return $this;
    }

    public function getEnergy(): ?int
    {
        return $this->energy;
    }

    public function setEnergy(?int $energy): self
    {
        $this->energy = $energy;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }
}
