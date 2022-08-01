<?php

namespace App\Entity;

use App\Repository\MassCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MassCategoryRepository::class)]
class MassCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'massCategory', targetEntity: Massage::class)]
    private Collection $massages;

    public function __construct()
    {
        $this->massages = new ArrayCollection();
    }

    public function __toString(){
        return $this->getName();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
            $massage->setMassCategory($this);
        }

        return $this;
    }

    public function removeMassage(Massage $massage): self
    {
        if ($this->massages->removeElement($massage)) {
            // set the owning side to null (unless already changed)
            if ($massage->getMassCategory() === $this) {
                $massage->setMassCategory(null);
            }
        }

        return $this;
    }
}
