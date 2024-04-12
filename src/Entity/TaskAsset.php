<?php

namespace App\Entity;

use App\Repository\TaskAssetRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskAssetRepository::class)]
class TaskAsset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1500, nullable: true)]
    private ?string $content = null;

    #[ORM\ManyToOne(inversedBy: 'taskAsset')]
    private ?TaskAssetType $taskAssetType = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getTaskAssetType(): ?TaskAssetType
    {
        return $this->taskAssetType;
    }

    public function setTaskAssetType(?TaskAssetType $taskAssetType): static
    {
        $this->taskAssetType = $taskAssetType;

        return $this;
    }
}
