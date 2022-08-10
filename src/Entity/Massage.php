<?php

namespace App\Entity;

use App\Repository\MassageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MassageRepository::class)]
class Massage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 45)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $undertitle = null;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $explication = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $problem = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $good = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $work = null;

    #[ORM\Column]
    private ?bool $oil = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'massages')]
    #[ORM\JoinColumn(nullable: false)]
    private ?MassCategory $massCategory = null;

    #[ORM\ManyToMany(targetEntity: Pack::class, inversedBy: 'packHasMassages')]
    private Collection $pack;

    #[ORM\ManyToOne(inversedBy: 'massages')]
    private ?PackCatSolo $packCatSolo = null;

    #[ORM\ManyToOne(inversedBy: 'massages')]
    private ?PackCatMulti $packCatMulti = null;

    public function __construct()
    {
        $this->pack = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUndertitle(): ?string
    {
        return $this->undertitle;
    }

    public function setUndertitle(string $undertitle): self
    {
        $this->undertitle = $undertitle;

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

    public function getExplication(): ?string
    {
        return $this->explication;
    }

    public function setExplication(string $explication): self
    {
        $this->explication = $explication;

        return $this;
    }

    public function getProblem(): ?string
    {
        return $this->problem;
    }

    public function setProblem(string $problem): self
    {
        $this->problem = $problem;

        return $this;
    }

    public function getGood(): ?string
    {
        return $this->good;
    }

    public function setGood(string $good): self
    {
        $this->good = $good;

        return $this;
    }

    public function getWork(): ?string
    {
        return $this->work;
    }

    public function setWork(string $work): self
    {
        $this->work = $work;

        return $this;
    }

    public function isOil(): ?bool
    {
        return $this->oil;
    }

    public function setOil(bool $oil): self
    {
        $this->oil = $oil;

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

    public function getMassCategory(): ?MassCategory
    {
        return $this->massCategory;
    }

    public function setMassCategory(?MassCategory $massCategory): self
    {
        $this->massCategory = $massCategory;

        return $this;
    }

    /**
     * @return Collection<int, Pack>
     */
    public function getPack(): Collection
    {
        return $this->pack;
    }

    public function addPack(Pack $pack): self
    {
        if (!$this->pack->contains($pack)) {
            $this->pack[] = $pack;
        }

        return $this;
    }

    public function removePack(Pack $pack): self
    {
        $this->pack->removeElement($pack);

        return $this;
    }

    public function getPackCatSolo(): ?PackCatSolo
    {
        return $this->packCatSolo;
    }

    public function setPackCatSolo(?PackCatSolo $packCatSolo): self
    {
        $this->packCatSolo = $packCatSolo;

        return $this;
    }

    public function getPackCatMulti(): ?PackCatMulti
    {
        return $this->packCatMulti;
    }

    public function setPackCatMulti(?PackCatMulti $packCatMulti): self
    {
        $this->packCatMulti = $packCatMulti;

        return $this;
    }
}
