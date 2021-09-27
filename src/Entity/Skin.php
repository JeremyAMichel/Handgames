<?php

namespace App\Entity;

use App\Repository\SkinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkinRepository::class)
 */
class Skin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $rockUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $scissorUrl;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paperUrl;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="skins")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRockUrl(): ?string
    {
        return $this->rockUrl;
    }

    public function setRockUrl(string $rockUrl): self
    {
        $this->rockUrl = $rockUrl;

        return $this;
    }

    public function getScissorUrl(): ?string
    {
        return $this->scissorUrl;
    }

    public function setScissorUrl(string $scissorUrl): self
    {
        $this->scissorUrl = $scissorUrl;

        return $this;
    }

    public function getPaperUrl(): ?string
    {
        return $this->paperUrl;
    }

    public function setPaperUrl(string $paperUrl): self
    {
        $this->paperUrl = $paperUrl;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->addSkin($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeSkin($this);
        }

        return $this;
    }
}
