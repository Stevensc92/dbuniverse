<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     */
    private $user;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $receiveAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isWatched;

    public function __construct()
    {
        $this->receiveAt = new \DateTime();
        $this->isWatched = false;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getReceiveAt(): ?\DateTimeInterface
    {
        return $this->receiveAt;
    }

    public function setReceiveAt(\DateTimeInterface $receiveAt): self
    {
        $this->receiveAt = $receiveAt;

        return $this;
    }

    public function getIsWatched(): ?bool
    {
        return $this->isWatched;
    }

    public function setIsWatched(bool $isWatched): self
    {
        $this->isWatched = $isWatched;

        return $this;
    }
}
