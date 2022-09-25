<?php

namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use DateTime;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

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

    #[ORM\Column(length: 50)]
    private ?string $u_name = null ;

    #[ORM\Column(length: 7)]
    private ?string $u_color = null;

    #[ORM\Column]
    private ?bool $u_active_notification = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?DateTimeInterface $u_hour_notification = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Favorite::class, orphanRemoval: true)]
    private Collection $favorites;

    #[ORM\ManyToOne(inversedBy: 'users', cascade:["persist"])]
    #[ORM\JoinColumn(nullable: false)]
    private ?home $home = null;



        /**
     * Constructor
     */
    public function __construct()
    {
   
        $this->u_hour_notification = new DateTime("18:30:00");
        
        $this->u_active_notification = true;
        $this->u_color = "green";
        $this->u_name = "user";
       // $this->home = new home;
        $this->favorites = new ArrayCollection();
       
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
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getUName(): ?string
    {
        return $this->u_name;
    }

    public function setUName(string $u_name): self
    {
        $this->u_name = $u_name;

        return $this;
    }

    public function getUColor(): ?string
    {
        return $this->u_color;
    }

    public function setUColor(string $u_color): self
    {
        $this->u_color = $u_color;

        return $this;
    }

    public function isUActiveNotification(): ?bool
    {
        return $this->u_active_notification;
    }

    public function setUActiveNotification(bool $u_active_notification): self
    {
        $this->u_active_notification = $u_active_notification;

        return $this;
    }

    public function getUHourNotification(): ?\DateTimeInterface
    {
        return $this->u_hour_notification;
    }

    public function setUHourNotification(\DateTimeInterface $u_hour_notification): self
    {
        $this->u_hour_notification = $u_hour_notification;

        return $this;
    }

    /**
     * @return Collection<int, Favorite>
     */
    public function getFavorites(): Collection
    {
        return $this->favorites;
    }

    public function addFavorite(Favorite $favorite): self
    {
        if (!$this->favorites->contains($favorite)) {
            $this->favorites->add($favorite);
            $favorite->setUser($this);
        }

        return $this;
    }

    public function removeFavorite(Favorite $favorite): self
    {
        if ($this->favorites->removeElement($favorite)) {
            // set the owning side to null (unless already changed)
            if ($favorite->getUser() === $this) {
                $favorite->setUser(null);
            }
        }

        return $this;
    }

    public function getHome(): ?home
    {
        return $this->home;
    }

    public function setHome(?home $home): self
    {
        $this->home = $home;

        return $this;
    }
}
