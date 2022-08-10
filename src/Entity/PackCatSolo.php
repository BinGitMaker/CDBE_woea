<?php

namespace App\Entity;

use App\Repository\PackCatSoloRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PackCatSoloRepository::class)]
class PackCatSolo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'packCatSolo', targetEntity: Massage::class)]
    private Collection $massages;

    public function __construct()
    {
        $this->massages = new ArrayCollection();
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

    /**
     * @return Collection<int, Massage>
     */
    public function getMassages(): Collection
    {
        return $this->massages;
    }

    public function addMassage(Massage $massage): self
    {
        if (!$this->massages->contains($massage)) {
            $this->massages[] = $massage;
            $massage->setPackCatSolo($this);
        }

        return $this;
    }

    public function removeMassage(Massage $massage): self
    {
        if ($this->massages->removeElement($massage)) {
            // set the owning side to null (unless already changed)
            if ($massage->getPackCatSolo() === $this) {
                $massage->setPackCatSolo(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

}
