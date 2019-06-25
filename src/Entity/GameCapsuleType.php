<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GameCapsuleTypeRepository")
 */
class GameCapsuleType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\GameCapsule", mappedBy="type")
     */
    private $gameCapsules;

    public function __construct()
    {
        $this->gameCapsules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|GameCapsule[]
     */
    public function getGameCapsules(): Collection
    {
        return $this->gameCapsules;
    }

    public function addGameCapsule(GameCapsule $gameCapsule): self
    {
        if (!$this->gameCapsules->contains($gameCapsule)) {
            $this->gameCapsules[] = $gameCapsule;
            $gameCapsule->setType($this);
        }

        return $this;
    }

    public function removeGameCapsule(GameCapsule $gameCapsule): self
    {
        if ($this->gameCapsules->contains($gameCapsule)) {
            $this->gameCapsules->removeElement($gameCapsule);
            // set the owning side to null (unless already changed)
            if ($gameCapsule->getType() === $this) {
                $gameCapsule->setType(null);
            }
        }

        return $this;
    }
}
