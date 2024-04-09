<?php

namespace App\Entity;

use App\Repository\HistoryTaskAssetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HistoryTaskAssetRepository::class)]
class HistoryTaskAsset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 500)]
    private ?string $event = null;

    #[ORM\Column]
    private ?int $EntityId = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEvent(): ?string
    {
        return $this->event;
    }

    public function setEvent(string $event): static
    {
        $this->event = $event;

        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->EntityId;
    }

    public function setEntityId(int $EntityId): static
    {
        $this->EntityId = $EntityId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
