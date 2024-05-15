<?php

namespace App\Entity;

use App\Repository\TaskRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TaskRepository::class)]
class Task
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $updated_at = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?int $priority = null;

    /**
     * @var Collection<int, ListOfTodo>
     */
    #[ORM\OneToMany(targetEntity: ListOfTodo::class, mappedBy: 'tasks')]
    private Collection $listOfTodos;

    #[ORM\ManyToOne(inversedBy: 'tasks')]
    private ?Step $step = null;

    public function __construct()
    {
        $this->listOfTodos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): static
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return Collection<int, ListOfTodo>
     */
    public function getListOfTodos(): Collection
    {
        return $this->listOfTodos;
    }

    public function addListOfTodo(ListOfTodo $listOfTodo): static
    {
        if (!$this->listOfTodos->contains($listOfTodo)) {
            $this->listOfTodos->add($listOfTodo);
            $listOfTodo->setTasks($this);
        }

        return $this;
    }

    public function removeListOfTodo(ListOfTodo $listOfTodo): static
    {
        if ($this->listOfTodos->removeElement($listOfTodo)) {
            // set the owning side to null (unless already changed)
            if ($listOfTodo->getTasks() === $this) {
                $listOfTodo->setTasks(null);
            }
        }

        return $this;
    }

    public function getStep(): ?Step
    {
        return $this->step;
    }

    public function setStep(?Step $step): static
    {
        $this->step = $step;

        return $this;
    }
}
