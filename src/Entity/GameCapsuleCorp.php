<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameCapsuleCorpRepository")
 */
class GameCapsuleCorp
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\GameCapsule", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $capsule;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\Column(type="datetime")
     */
    private $refreshAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCapsule(): ?GameCapsule
    {
        return $this->capsule;
    }

    public function setCapsule(GameCapsule $capsule): self
    {
        $this->capsule = $capsule;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getRefreshAt(): ?\DateTimeInterface
    {
        return $this->refreshAt;
    }

    public function setRefreshAt(\DateTimeInterface $refreshAt): self
    {
        $this->refreshAt = $refreshAt;

        return $this;
    }
}
