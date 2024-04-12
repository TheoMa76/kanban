<?php

namespace App\Entity;

use App\Repository\TaskAssetTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
}
