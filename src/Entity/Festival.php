<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\FestivalRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FestivalRepository::class)]
class Festival
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $annee = null;

    #[ORM\Column(length: 255)]
    private ?string $logo = null;

    #[ORM\ManyToOne(inversedBy: 'leFestival')]
    private ?Programmation $lesProgrammations = null;

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

    public function getAnnee(): ?\DateTimeInterface
    {
        return $this->annee;
    }

    public function setAnnee(\DateTimeInterface $annee): static
    {
        $this->annee = $annee;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(string $logo): static
    {
        $this->logo = $logo;

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

        public function getGroupesAtDate($date): ArrayCollection
        {
            $groupes = new ArrayCollection();
            $programmations = $this->getLesProgrammations();

            foreach ($programmations as $programmation)
            {
                if ($programmation->getDate() === $date)
                {
                    $groupe = $programmation->getLeGroupe();
                    $groupes->add($groupe);
                }
            }

            return $groupes;
        }

}
