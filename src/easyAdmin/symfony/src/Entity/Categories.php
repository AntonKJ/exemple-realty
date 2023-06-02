<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoriesRepository::class)
 */
class Categories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publishDate;

    /**
     * @ORM\ManyToMany(targetEntity=Rooms::class, mappedBy="sections")
     */
    private $room;

    public function __construct()
    {
        $this->room = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    public function setPublishDate(\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function __toString(): string
    {
        return $this->name.' '.$this->title;
    }

    public function getFullName(): string
    {
        return $this->name.' '.$this->title;
    }


    /**
     * @return Collection|Rooms[]
     */
    public function getRoom(): Collection
    {
        return $this->room;
    }

    public function addRoom(Rooms $room): self
    {
        if (!$this->room->contains($room)) {
            $this->room[] = $room;
            $room->addSection($this);
        }

        return $this;
    }

    public function removeRoom(Rooms $room): self
    {
        if ($this->room->removeElement($room)) {
            $room->removeSection($this);
        }

        return $this;
    }
}
