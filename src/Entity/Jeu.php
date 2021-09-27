<?php

namespace App\Entity;

use App\Repository\JeuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=JeuRepository::class)
 */
class Jeu
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
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $regle;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrjoueur;

    /**
     * @ORM\OneToMany(targetEntity=Classement::class, mappedBy="jeu")
     */
    private $classements;

    public function __construct()
    {
        $this->classements = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getRegle(): ?string
    {
        return $this->regle;
    }

    public function setRegle(?string $regle): self
    {
        $this->regle = $regle;

        return $this;
    }

    public function getNbrjoueur(): ?int
    {
        return $this->nbrjoueur;
    }

    public function setNbrjoueur(int $nbrjoueur): self
    {
        $this->nbrjoueur = $nbrjoueur;

        return $this;
    }

    /**
     * @return Collection|Classement[]
     */
    public function getClassements(): Collection
    {
        return $this->classements;
    }

    public function addClassement(Classement $classement): self
    {
        if (!$this->classements->contains($classement)) {
            $this->classements[] = $classement;
            $classement->setJeu($this);
        }

        return $this;
    }

    public function removeClassement(Classement $classement): self
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getJeu() === $this) {
                $classement->setJeu(null);
            }
        }

        return $this;
    }

}
