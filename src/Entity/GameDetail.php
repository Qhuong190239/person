<?php

namespace App\Entity;

use App\Entity\Game;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\GameDetailRepository;

#[ORM\Entity(repositoryClass: GameDetailRepository::class)]
class GameDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'float')]
    private $price;

    #[ORM\Column(type: 'date')]
    private $birthday;

    #[ORM\Column(type: 'string', length: 255)]
    private $platform;

    #[ORM\OneToOne(mappedBy: 'detail', targetEntity: Game::class, cascade: ['persist', 'remove'])]
    private $game;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthday(): ?\DateTimeInterface
    {
        return $this->birthday;
    }

    public function setBirthday(\DateTimeInterface $birthday): self
    {
        $this->birthday = $birthday;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        // unset the owning side of the relation if necessary
        if ($game === null && $this->game !== null) {
            $this->game->setDetail(null);
        }

        // set the owning side of the relation if necessary
        if ($game !== null && $game->getDetail() !== $this) {
            $game->setDetail($this);
        }

        $this->game = $game;

        return $this;
    }

    public function getPlatform(): ?string
    {
        return $this->platform;
    }

    public function setPlatform(string $platform): self
    {
        $this->platform = $platform;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
