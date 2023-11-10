<?php

namespace App\Entity;

use App\Repository\StageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StageRepository::class)]
class Stage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    private ?string $imagePath = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateStart = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateEnd = null;

    #[ORM\Column]
    private ?int $nbMaxPeople = null;

    #[ORM\Column]
    private ?int $priceAdult = null;

    #[ORM\Column(nullable: true)]
    private ?int $priceChild = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Adress $adress = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): static
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getDateStart(): ?\DateTimeInterface
    {
        return $this->dateStart;
    }

    public function setDateStart(\DateTimeInterface $dateStart): static
    {
        $this->dateStart = $dateStart;

        return $this;
    }

    public function getDateEnd(): ?\DateTimeInterface
    {
        return $this->dateEnd;
    }

    public function setDateEnd(\DateTimeInterface $dateEnd): static
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    public function getNbMaxPeople(): ?int
    {
        return $this->nbMaxPeople;
    }

    public function setNbMaxPeople(int $nbMaxPeople): static
    {
        $this->nbMaxPeople = $nbMaxPeople;

        return $this;
    }

    public function getPriceAdult(): ?int
    {
        return $this->priceAdult;
    }

    public function setPriceAdult(int $priceAdult): static
    {
        $this->priceAdult = $priceAdult;

        return $this;
    }

    public function getPriceChild(): ?int
    {
        return $this->priceChild;
    }

    public function setPriceChild(?int $priceChild): static
    {
        $this->priceChild = $priceChild;

        return $this;
    }

    public function getAdress(): ?Adress
    {
        return $this->adress;
    }

    public function setAdress(?Adress $adress): static
    {
        $this->adress = $adress;

        return $this;
    }
}
