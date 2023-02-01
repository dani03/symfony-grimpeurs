<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(nullable: true)]
    private ?int $points = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Jpo::class)]
    private Collection $jpos;

    #[ORM\ManyToMany(targetEntity: Jpo::class, mappedBy: 'users')]
    private Collection $no;

    #[ORM\ManyToOne(inversedBy: 'users')]
    private ?level $level_id = null;


    public function __construct()
    {
        $this->jpos = new ArrayCollection();
        $this->jpoUsers = new ArrayCollection();
        $this->no = new ArrayCollection();
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
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_BRONZE';

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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPoints(): ?int
    {
        return $this->points;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * @return Collection<int, Jpo>
     */
    public function getJpos(): Collection
    {
        return $this->jpos;
    }

    public function addJpo(Jpo $jpo): self
    {
        if (!$this->jpos->contains($jpo)) {
            $this->jpos->add($jpo);
            $jpo->setUser($this);
        }

        return $this;
    }

    public function removeJpo(Jpo $jpo): self
    {
        if ($this->jpos->removeElement($jpo)) {
            // set the owning side to null (unless already changed)
            if ($jpo->getUser() === $this) {
                $jpo->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Jpo>
     */
    public function getNo(): Collection
    {
        return $this->no;
    }

    public function addNo(Jpo $no): self
    {
        if (!$this->no->contains($no)) {
            $this->no->add($no);
            $no->addUser($this);
        }

        return $this;
    }

    public function removeNo(Jpo $no): self
    {
        if ($this->no->removeElement($no)) {
            $no->removeUser($this);
        }

        return $this;
    }

    public function getLevelId(): ?level
    {
        return $this->level_id;
    }

    public function setLevelId(?level $level_id): self
    {
        $this->level_id = $level_id;

        return $this;
    }

}
