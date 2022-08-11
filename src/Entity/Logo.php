<?php

namespace App\Entity;

use App\Repository\LogoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LogoRepository::class)]
class Logo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoPro = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $logoProInversed = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogoPro(): ?string
    {
        return $this->logoPro;
    }

    public function setLogoPro(?string $logoPro): self
    {
        $this->logoPro = $logoPro;

        return $this;
    }

    public function getLogoProInversed(): ?string
    {
        return $this->logoProInversed;
    }

    public function setLogoProInversed(?string $logoProInversed): self
    {
        $this->logoProInversed = $logoProInversed;

        return $this;
    }
}
