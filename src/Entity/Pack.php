<?php

namespace App\Entity;

use App\Repository\PackRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackRepository::class)]
class Pack
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $time = null;

    #[ORM\Column]
    private ?int $price = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 70)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $isSolo = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $modality = null;

    #[ORM\ManyToMany(targetEntity: Massage::class, mappedBy: 'pack')]
    private Collection $packHasMassages;

    public function __construct()
    {
        $this->packHasMassages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?int
    {
        return $this->time;
    }

    public function setTime(int $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
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

    public function isIsSolo(): ?bool
    {
        return $this->isSolo;
    }

    public function setIsSolo(bool $isSolo): self
    {
        $this->isSolo = $isSolo;

        return $this;
    }

    public function getModality(): ?string
    {
        return $this->modality;
    }

    public function setModality(?string $modality): self
    {
        $this->modality = $modality;

        return $this;
    }

    /**
     * @return Collection<int, Massage>
     */
    public function getPackHasMassages(): Collection
    {
        return $this->packHasMassages;
    }

    public function addPackHasMassage(Massage $packHasMassage): self
    {
        if (!$this->packHasMassages->contains($packHasMassage)) {
            $this->packHasMassages[] = $packHasMassage;
            $packHasMassage->addPack($this);
        }

        return $this;
    }

    public function removePackHasMassage(Massage $packHasMassage): self
    {
        if ($this->packHasMassages->removeElement($packHasMassage)) {
            $packHasMassage->removePack($this);
        }

        return $this;
    }
}
