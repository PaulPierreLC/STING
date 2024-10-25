<?php

namespace App\Entity;

use App\Repository\GroupeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use PSpell\Dictionary;

#[ORM\Entity(repositoryClass: GroupeRepository::class)]
class Groupe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $genreMusical = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(length: 255)]
    private ?string $urlPageWeb = null;

    #[ORM\ManyToOne(inversedBy: 'leGroupe')]
    private ?Programmation $lesProgrammations = null;

    /**
     * @var Collection<int, Album>
     */
    #[ORM\OneToMany(targetEntity: Album::class, mappedBy: 'leGroupe')]
    private Collection $lesAlbums;

    public function __construct()
    {
        $this->lesAlbums = new ArrayCollection();
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

    public function getGenreMusical(): ?string
    {
        return $this->genreMusical;
    }

    public function setGenreMusical(string $genreMusical): static
    {
        $this->genreMusical = $genreMusical;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): static
    {
        $this->photo = $photo;

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

    public function getLesProgrammations(): ?Programmation
    {
        return $this->lesProgrammations;
    }

    public function setLesProgrammations(?Programmation $lesProgrammations): static
    {
        $this->lesProgrammations = $lesProgrammations;

        return $this;
    }

    /**
     * @return Collection<int, Album>
     */
    public function getLesAlbums(): Collection
    {
        return $this->lesAlbums;
    }

    public function addLesAlbum(Album $lesAlbum): static
    {
        if (!$this->lesAlbums->contains($lesAlbum)) {
            $this->lesAlbums->add($lesAlbum);
            $lesAlbum->setLeGroupe($this);
        }

        return $this;
    }

    public function removeLesAlbum(Album $lesAlbum): static
    {
        if ($this->lesAlbums->removeElement($lesAlbum)) {
            // set the owning side to null (unless already changed)
            if ($lesAlbum->getLeGroupe() === $this) {
                $lesAlbum->setLeGroupe(null);
            }
        }

        return $this;
    }

    public function getLesAlbumsEtTitres(): array
    {
        $titreAlbum = [];

        $albums = $this->getLesAlbums();

        foreach ($albums as $album) {
            $titres = $album->getLesTitres();

            foreach ($titres as $titre) {
                $titreAlbum[$titre->getNom()] = $album->getNom();
            }
        }

        return $titreAlbum;
    }
}
