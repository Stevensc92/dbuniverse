<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameUserRepository")
 */
class GameUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="gameUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $current_character;

    /**
     * @ORM\Column(type="bigint")
     */
    private $zenis;

    /**
     * @ORM\Column(type="integer")
     */
    private $searches;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $last_refresh_searches_at;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;


    public function __construct()
    {
        $this->current_character = 1;
        $this->zenis = 5000;
        $this->searches = 5;
        $this->last_refresh_searches_at = null;
        $this->is_active = true;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCurrentCharacter(): ?int
    {
        return $this->current_character;
    }

    public function setCurrentCharacter(int $current_character): self
    {
        $this->current_character = $current_character;

        return $this;
    }

    public function getZenis(): ?int
    {
        return $this->zenis;
    }

    public function setZenis(int $zenis): self
    {
        $this->zenis = $zenis;

        return $this;
    }

    public function getSearches(): ?int
    {
        return $this->searches;
    }

    public function setSearches(int $searches): self
    {
        $this->searches = $searches;

        return $this;
    }

    public function getLastRefreshSearchesAt(): ?\DateTimeInterface
    {
        return $this->last_refresh_searches_at;
    }

    public function setLastRefreshSearchesAt(?\DateTimeInterface $last_refresh_searches_at): self
    {
        $this->last_refresh_searches_at = $last_refresh_searches_at;

        return $this;
    }

    public function getIsActive(): ?bool
    {
        return $this->is_active;
    }

    public function setIsActive(bool $is_active): self
    {
        $this->is_active = $is_active;

        return $this;
    }
}
