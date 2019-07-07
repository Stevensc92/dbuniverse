<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameCapsuleLevelRepository")
 */
class GameCapsuleLevel
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\GameCapsuleType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @ORM\Column(type="integer")
     */
    private $exp_required;

    /**
     * @ORM\Column(type="integer")
     */
    private $bonus;

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

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getExpRequired(): ?int
    {
        return $this->exp_required;
    }

    public function setExpRequired(int $exp_required): self
    {
        $this->exp_required = $exp_required;

        return $this;
    }

    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }
}
