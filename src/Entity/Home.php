<?php

namespace App\Entity;

use App\Repository\HomeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HomeRepository::class)]
class Home
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $h_name = null;

    #[ORM\Column(length: 25)]
    private ?string $h_key = null;

    #[ORM\Column(length: 255)]
    private ?string $h_password = null;

    #[ORM\OneToMany(mappedBy: 'home', targetEntity: HomeProduct::class, orphanRemoval: true)]
    private Collection $homeProducts;

    #[ORM\OneToMany(mappedBy: 'home', targetEntity: User::class, orphanRemoval: true)]
    private Collection $users;

    public function __construct()
    {
        $this->homeProducts = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHName(): ?string
    {
        return $this->h_name;
    }

    public function setHName(string $h_name): self
    {
        $this->h_name = $h_name;

        return $this;
    }

    public function getHKey(): ?string
    {
        return $this->h_key;
    }

    public function setHKey(string $h_key): self
    {
        $this->h_key = $h_key;

        return $this;
    }

    public function getHPassword(): ?string
    {
        return $this->h_password;
    }

    public function setHPassword(string $h_password): self
    {
        $this->h_password = $h_password;

        return $this;
    }

    /**
     * @return Collection<int, HomeProduct>
     */
    public function getHomeProducts(): Collection
    {
        return $this->homeProducts;
    }

    public function addHomeProduct(HomeProduct $homeProduct): self
    {
        if (!$this->homeProducts->contains($homeProduct)) {
            $this->homeProducts->add($homeProduct);
            $homeProduct->setHome($this);
        }

        return $this;
    }

    public function removeHomeProduct(HomeProduct $homeProduct): self
    {
        if ($this->homeProducts->removeElement($homeProduct)) {
            // set the owning side to null (unless already changed)
            if ($homeProduct->getHome() === $this) {
                $homeProduct->setHome(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setHome($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getHome() === $this) {
                $user->setHome(null);
            }
        }

        return $this;
    }
}
