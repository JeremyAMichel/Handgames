<?php

namespace App\Entity;

use App\Repository\UserSkinRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserSkinRepository::class)
 */
class UserSkin
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isActiveSkin;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userSkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Skin::class, inversedBy="userSkins")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsActiveSkin(): ?bool
    {
        return $this->isActiveSkin;
    }

    public function setIsActiveSkin(bool $isActiveSkin): self
    {
        $this->isActiveSkin = $isActiveSkin;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSkin(): ?Skin
    {
        return $this->skin;
    }

    public function setSkin(?Skin $skin): self
    {
        $this->skin = $skin;

        return $this;
    }
}
