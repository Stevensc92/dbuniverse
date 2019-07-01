<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameUserInventoryRepository")
 */
class GameUserInventory
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameUser", inversedBy="inventories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameUserCharacter", inversedBy="stuff")
     */
    private $userCharacter;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GameCapsule", cascade={"persist", "remove"})
     */
    private $capsule;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GameEquipment", cascade={"persist", "remove"})
     */
    private $equipment;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $experience;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?GameUser
    {
        return $this->user;
    }

    public function setUser(?GameUser $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUserCharacter(): ?GameUserCharacter
    {
        return $this->userCharacter;
    }

    public function setUserCharacter(?GameUserCharacter $userCharacter): self
    {
        $this->userCharacter = $userCharacter;

        return $this;
    }

    public function getCapsule(): ?GameCapsule
    {
        return $this->capsule;
    }

    public function setCapsule(?GameCapsule $capsule): self
    {
        $this->capsule = $capsule;

        return $this;
    }

    public function getEquipment(): ?GameEquipment
    {
        return $this->equipment;
    }

    public function setEquipment(?GameEquipment $equipment): self
    {
        $this->equipment = $equipment;

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
}
