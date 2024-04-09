<?php

namespace App\Entity;

use App\Repository\TaskAssetTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskAssetTypeRepository::class)]
class TaskAssetType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    /**
     * @var Collection<int, TaskAsset>
     */
    #[ORM\OneToMany(targetEntity: TaskAsset::class, mappedBy: 'taskAssetType')]
    private Collection $taskAsset;

    #[ORM\Column(length: 50)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = 'on';

    public function __construct()
    {
        $this->taskAsset = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, TaskAsset>
     */
    public function getTaskAsset(): Collection
    {
        return $this->taskAsset;
    }

    public function addTaskAsset(TaskAsset $taskAsset): static
    {
        if (!$this->taskAsset->contains($taskAsset)) {
            $this->taskAsset->add($taskAsset);
            $taskAsset->setTaskAssetType($this);
        }

        return $this;
    }

    public function removeTaskAsset(TaskAsset $taskAsset): static
    {
        if ($this->taskAsset->removeElement($taskAsset)) {
            // set the owning side to null (unless already changed)
            if ($taskAsset->getTaskAssetType() === $this) {
                $taskAsset->setTaskAssetType(null);
            }
        }

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
