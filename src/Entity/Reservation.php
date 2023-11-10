<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbAdult = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbChild = null;

    #[ORM\Column]
    private ?bool $isPayed = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Stage $stage = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbAdult(): ?int
    {
        return $this->nbAdult;
    }

    public function setNbAdult(int $nbAdult): static
    {
        $this->nbAdult = $nbAdult;

        return $this;
    }

    public function getNbChild(): ?int
    {
        return $this->nbChild;
    }

    public function setNbChild(?int $nbChild): static
    {
        $this->nbChild = $nbChild;

        return $this;
    }

    public function isIsPayed(): ?bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(bool $isPayed): static
    {
        $this->isPayed = $isPayed;

        return $this;
    }

    public function getStage(): ?Stage
    {
        return $this->stage;
    }

    public function setStage(?Stage $stage): static
    {
        $this->stage = $stage;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
