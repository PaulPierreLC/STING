<?php

namespace App\Entity;

use App\Repository\TitreRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TitreRepository::class)]
class Titre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $urlPageWeb = null;

    #[ORM\Column(length: 255)]
    private ?int $duree = null;

    #[ORM\Column(length: 255)]
    private ?string $extraitAudio = null;

    #[ORM\ManyToOne(inversedBy: 'lesTitres')]
    private ?album $leAlbum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getUrlPageWeb(): ?string
    {
        return $this->urlPageWeb;
    }

    public function setUrlPageWeb(string $urlPageWeb): static
    {
        $this->urlPageWeb = $urlPageWeb;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getExtraitAudio(): ?string
    {
        return $this->extraitAudio;
    }

    public function setExtraitAudio(string $extraitAudio): static
    {
        $this->extraitAudio = $extraitAudio;

        return $this;
    }

    public function getLeAlbum(): ?album
    {
        return $this->leAlbum;
    }

    public function setLeAlbum(?album $leAlbum): static
    {
        $this->leAlbum = $leAlbum;

        return $this;
    }

    public function getDureeMinute(): string
    {
        return sprintf("%02d:%02d%", ($this->duree/60)%60, $this->duree%60);
    }
}
