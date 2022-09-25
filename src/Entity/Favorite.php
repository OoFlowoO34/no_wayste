<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FavoriteRepository;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $f_addition_date = null;

    #[ORM\Column(nullable: true)]
    private ?int $f_order_number = null;

    #[ORM\ManyToOne(inversedBy: 'favorites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'favorites')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    // public function __construct()
    // {
    //     $this->f_addition_date = new \DateTimeImmutable();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFAdditionDate(): ?\DateTime
    {
        return $this->f_addition_date;
    }

    public function setFAdditionDate(?\DateTime $f_addition_date): self
    {
        $this->f_addition_date = $f_addition_date;

        return $this;
    }

    public function getFOrderNumber(): ?int
    {
        return $this->f_order_number;
    }

    public function setFOrderNumber(?int $f_order_number): self
    {
        $this->f_order_number = $f_order_number;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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
}
