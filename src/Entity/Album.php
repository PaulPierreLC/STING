<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
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
    private ?string $photoPochette = null;

    /**
     * @var Collection<int, Titre>
     */
    #[ORM\OneToMany(targetEntity: Titre::class, mappedBy: 'leAlbum')]
    private Collection $lesTitres;

    #[ORM\ManyToOne(inversedBy: 'lesAlbums')]
    private ?groupe $leGroupe = null;

    public function __construct()
    {
        $this->lesTitres = new ArrayCollection();
    }

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

    public function getPhotoPochette(): ?string
    {
        return $this->photoPochette;
    }

    public function setPhotoPochette(string $photoPochette): static
    {
        $this->photoPochette = $photoPochette;

        return $this;
    }

    /**
     * @return Collection<int, Titre>
     */
    public function getLesTitres(): Collection
    {
        return $this->lesTitres;
    }

    public function addLesTitre(Titre $lesTitre): static
    {
        if (!$this->lesTitres->contains($lesTitre)) {
            $this->lesTitres->add($lesTitre);
            $lesTitre->setLeAlbum($this);
        }

        return $this;
    }

    public function removeLesTitre(Titre $lesTitre): static
    {
        if ($this->lesTitres->removeElement($lesTitre)) {
            // set the owning side to null (unless already changed)
            if ($lesTitre->getLeAlbum() === $this) {
                $lesTitre->setLeAlbum(null);
            }
        }

        return $this;
    }

    public function getLeGroupe(): ?groupe
    {
        return $this->leGroupe;
    }

    public function setLeGroupe(?groupe $leGroupe): static
    {
        $this->leGroupe = $leGroupe;

        return $this;
    }

    public function getLesTitres2(?groupe $leGroupe): Collection
    {
        return $this->lesTitres;
    }
}
