<?php

namespace App\Entity;

use App\Repository\AboutRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AboutRepository::class)]
class About
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $undertitle = null;

    #[ORM\Column(length: 255)]
    private ?string $title1 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description1 = null;

    #[ORM\Column(length: 255)]
    private ?string $pics1 = null;

    #[ORM\Column(length: 255)]
    private ?string $title2 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description2 = null;

    #[ORM\Column(length: 255)]
    private ?string $pics2 = null;

    #[ORM\Column(length: 255)]
    private ?string $title3 = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description3 = null;

    #[ORM\Column(length: 255)]
    private ?string $pics3 = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUndertitle(): ?string
    {
        return $this->undertitle;
    }

    public function setUndertitle(string $undertitle): self
    {
        $this->undertitle = $undertitle;

        return $this;
    }

    public function getTitle1(): ?string
    {
        return $this->title1;
    }

    public function setTitle1(string $title1): self
    {
        $this->title1 = $title1;

        return $this;
    }

    public function getDescription1(): ?string
    {
        return $this->description1;
    }

    public function setDescription1(string $description1): self
    {
        $this->description1 = $description1;

        return $this;
    }

    public function getPics1(): ?string
    {
        return $this->pics1;
    }

    public function setPics1(string $pics1): self
    {
        $this->pics1 = $pics1;

        return $this;
    }

    public function getTitle2(): ?string
    {
        return $this->title2;
    }

    public function setTitle2(string $title2): self
    {
        $this->title2 = $title2;

        return $this;
    }

    public function getDescription2(): ?string
    {
        return $this->description2;
    }

    public function setDescription2(string $description2): self
    {
        $this->description2 = $description2;

        return $this;
    }

    public function getPics2(): ?string
    {
        return $this->pics2;
    }

    public function setPics2(string $pics2): self
    {
        $this->pics2 = $pics2;

        return $this;
    }

    public function getTitle3(): ?string
    {
        return $this->title3;
    }

    public function setTitle3(string $title3): self
    {
        $this->title3 = $title3;

        return $this;
    }

    public function getDescription3(): ?string
    {
        return $this->description3;
    }

    public function setDescription3(string $description3): self
    {
        $this->description3 = $description3;

        return $this;
    }

    public function getPics3(): ?string
    {
        return $this->pics3;
    }

    public function setPics3(string $pics3): self
    {
        $this->pics3 = $pics3;

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }
}
