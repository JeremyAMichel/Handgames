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
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=UserSkin::class, mappedBy="skin", orphanRemoval=true)
     */
    private $userSkins;

    public function __construct()
    {
        $this->userSkins = new ArrayCollection();
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|UserSkin[]
     */
    public function getUserSkins(): Collection
    {
        return $this->userSkins;
    }

    public function addUserSkin(UserSkin $userSkin): self
    {
        if (!$this->userSkins->contains($userSkin)) {
            $this->userSkins[] = $userSkin;
            $userSkin->setSkin($this);
        }

        return $this;
    }

    public function removeUserSkin(UserSkin $userSkin): self
    {
        if ($this->userSkins->removeElement($userSkin)) {
            // set the owning side to null (unless already changed)
            if ($userSkin->getSkin() === $this) {
                $userSkin->setSkin(null);
            }
        }

        return $this;
    }
}
