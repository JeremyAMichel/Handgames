<?php

namespace App\Entity;

use App\Repository\StatistiqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatistiqueRepository::class)
 */
class Statistique
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrPartie;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrWin;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrLose;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, mappedBy="statistiques")
     */
    private $users;

    /**
     * @ORM\Column(type="integer")
     */
    private $level;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrPartie(): ?int
    {
        return $this->nbrPartie;
    }

    public function setNbrPartie(int $nbrPartie): self
    {
        $this->nbrPartie = $nbrPartie;

        return $this;
    }

    public function getNbrWin(): ?int
    {
        return $this->nbrWin;
    }

    public function setNbrWin(int $nbrWin): self
    {
        $this->nbrWin = $nbrWin;

        return $this;
    }

    public function getNbrLose(): ?int
    {
        return $this->nbrLose;
    }

    public function setNbrLose(int $nbrLose): self
    {
        $this->nbrLose = $nbrLose;

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
            $user->addStatistique($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeStatistique($this);
        }

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
}
