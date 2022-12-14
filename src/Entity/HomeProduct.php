<?php

namespace App\Entity;

use App\Repository\HomeProductRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HomeProductRepository::class)]
class HomeProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $hp_scan_date = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $hp_use_by_date = null;

    #[ORM\Column(nullable: true)]
    private ?bool $hp_consumed = null;

    #[ORM\ManyToOne(inversedBy: 'homeProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\ManyToOne(inversedBy: 'homeProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Home $home = null;


    /**
     * Constructor
     */
    // public function __construct()
    // {
    //     $this->hp_scan_date = new \DateTimeImmutable();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHpScanDate(): ?\DateTime
    {
        return $this->hp_scan_date;
    }

    public function setHpScanDate(\DateTime $hp_scan_date): self
    {
        $this->hp_scan_date = $hp_scan_date;

        return $this;
    }

    public function getHpUseByDate(): ?\DateTime
    {
        return $this->hp_use_by_date;
    }

    public function setHpUseByDate(?\DateTime $hp_use_by_date): self
    {
        $this->hp_use_by_date = $hp_use_by_date;

        return $this;
    }

    public function isHpConsumed(): ?bool
    {
        return $this->hp_consumed;
    }

    public function setHpConsumed(?bool $hp_consumed): self
    {
        $this->hp_consumed = $hp_consumed;

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

    public function getHome(): ?Home
    {
        return $this->home;
    }

    public function setHome(?Home $home): self
    {
        $this->home = $home;

        return $this;
    }
}
