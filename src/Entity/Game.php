<?php

namespace App\Entity;

use App\Entity\Genre;
use App\Entity\Publisher;
use App\Entity\GameDetail;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 30)]
    private $name;

    #[ORM\OneToOne(inversedBy: 'game', targetEntity: GameDetail::class, cascade: ['persist', 'remove'])]
    private $detail;

    #[ORM\ManyToMany(targetEntity: Publisher::class, inversedBy: 'people')]
    private $publisher;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'games')]
    private $genrecn;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    public function __construct()
    {
        $this->genre = new ArrayCollection();
        $this->publisher = new ArrayCollection();
        $this->genrecn = new ArrayCollection();
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

    public function getDetail(): ?GameDetail
    {
        return $this->detail;
    }

    public function setDetail(?GameDetail $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection<int, Publisher>
     */
    public function getPublisher(): Collection
    {
        return $this->publisher;
    }

    public function addPublisher(Publisher $publisher): self
    {
        if (!$this->publisher->contains($publisher)) {
            $this->publisher[] = $publisher;
        }

        return $this;
    }

    public function removePublisher(Publisher $publisher): self
    {
        $this->publisher->removeElement($publisher);

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenrecn(): Collection
    {
        return $this->genrecn;
    }

    public function addGenrecn(Genre $genrecn): self
    {
        if (!$this->genrecn->contains($genrecn)) {
            $this->genrecn[] = $genrecn;
        }

        return $this;
    }

    public function removeGenrecn(Genre $genrecn): self
    {
        $this->genrecn->removeElement($genrecn);

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }
}
