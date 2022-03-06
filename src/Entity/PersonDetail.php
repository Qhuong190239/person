<?php

namespace App\Entity;

use App\Repository\PersonDetailRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PersonDetailRepository::class)]
class PersonDetail
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $nationality;

    #[ORM\Column(type: 'string', length: 50)]
    private $address;

    #[ORM\Column(type: 'string', length: 10)]
    private $mobile;

    #[ORM\Column(type: 'date')]
    private $birthday;

    #[ORM\OneToOne(mappedBy: 'detail', targetEntity: Person::class, cascade: ['persist', 'remove'])]
    private $person;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
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

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): self
    {
        // unset the owning side of the relation if necessary
        if ($person === null && $this->person !== null) {
            $this->person->setDetail(null);
        }

        // set the owning side of the relation if necessary
        if ($person !== null && $person->getDetail() !== $this) {
            $person->setDetail($this);
        }

        $this->person = $person;

        return $this;
    }
}
