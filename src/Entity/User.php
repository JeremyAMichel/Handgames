<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pseudo;

    /**
     * @ORM\ManyToOne(targetEntity=Avatar::class, inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $avatar;

    /**
     * @ORM\ManyToMany(targetEntity=Trophee::class, inversedBy="users")
     */
    private $trophees;

    /**
     * @ORM\ManyToMany(targetEntity=Bordure::class, inversedBy="users")
     */
    private $bordures;

    /**
     * @ORM\ManyToMany(targetEntity=Statistique::class, inversedBy="users")
     */
    private $statistiques;

    /**
     * @ORM\ManyToMany(targetEntity=Skin::class, inversedBy="users")
     */
    private $skins;

    /**
     * @ORM\OneToMany(targetEntity=Classement::class, mappedBy="user")
     */
    private $classements;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;


    public function __construct()
    {
        $this->trophees = new ArrayCollection();
        $this->bordures = new ArrayCollection();
        $this->statistiques = new ArrayCollection();
        $this->skins = new ArrayCollection();
        $this->classements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string)$this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string)$this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getAvatar(): ?Avatar
    {
        return $this->avatar;
    }

    public function setAvatar(?Avatar $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * @return Collection|Trophee[]
     */
    public function getTrophees(): Collection
    {
        return $this->trophees;
    }

    public function addTrophee(Trophee $trophee): self
    {
        if (!$this->trophees->contains($trophee)) {
            $this->trophees[] = $trophee;
        }

        return $this;
    }

    public function removeTrophee(Trophee $trophee): self
    {
        $this->trophees->removeElement($trophee);

        return $this;
    }

    /**
     * @return Collection|Bordure[]
     */
    public function getBordures(): Collection
    {
        return $this->bordures;
    }

    public function addBordure(Bordure $bordure): self
    {
        if (!$this->bordures->contains($bordure)) {
            $this->bordures[] = $bordure;
        }

        return $this;
    }

    public function removeBordure(Bordure $bordure): self
    {
        $this->bordures->removeElement($bordure);

        return $this;
    }

    /**
     * @return Collection|Statistique[]
     */
    public function getStatistiques(): Collection
    {
        return $this->statistiques;
    }

    public function addStatistique(Statistique $statistique): self
    {
        if (!$this->statistiques->contains($statistique)) {
            $this->statistiques[] = $statistique;
        }

        return $this;
    }

    public function removeStatistique(Statistique $statistique): self
    {
        $this->statistiques->removeElement($statistique);

        return $this;
    }

    /**
     * @return Collection|Skin[]
     */
    public function getSkins(): Collection
    {
        return $this->skins;
    }

    public function addSkin(Skin $skin): self
    {
        if (!$this->skins->contains($skin)) {
            $this->skins[] = $skin;
        }

        return $this;
    }

    public function removeSkin(Skin $skin): self
    {
        $this->skins->removeElement($skin);

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
            $classement->setUser($this);
        }

        return $this;
    }

    public function removeClassement(Classement $classement): self
    {
        if ($this->classements->removeElement($classement)) {
            // set the owning side to null (unless already changed)
            if ($classement->getUser() === $this) {
                $classement->setUser(null);
            }
        }

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

}