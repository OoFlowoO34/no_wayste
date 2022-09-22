<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
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
    private ?string $u_name = null;

    #[ORM\Column(length: 7)]
    private ?string $u_color = null;

    #[ORM\Column]
    private ?bool $u_active_notification = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $u_hour_notification = null;

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
}
