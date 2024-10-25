<?php

namespace App\Entity;

use App\Repository\ProgrammationRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProgrammationRepository::class)]
class Programmation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    /**
     * @var Collection<int, groupe>
     */
    #[ORM\OneToMany(targetEntity: groupe::class, mappedBy: 'lesProgrammations')]
    private Collection $leGroupe;

    /**
     * @var Collection<int, festival>
     */
    #[ORM\OneToMany(targetEntity: festival::class, mappedBy: 'lesProgrammations')]
    private Collection $leFestival;

    public function __construct()
    {
        $this->leGroupe = new ArrayCollection();
        $this->leFestival = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, groupe>
     */
    public function getLeGroupe(): Collection
    {
        return $this->leGroupe;
    }

    public function addLeGroupe(groupe $leGroupe): static
    {
        if (!$this->leGroupe->contains($leGroupe)) {
            $this->leGroupe->add($leGroupe);
            $leGroupe->setLesProgrammations($this);
        }

        return $this;
    }

    public function removeLeGroupe(groupe $leGroupe): static
    {
        if ($this->leGroupe->removeElement($leGroupe)) {
            // set the owning side to null (unless already changed)
            if ($leGroupe->getLesProgrammations() === $this) {
                $leGroupe->setLesProgrammations(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, festival>
     */
    public function getLeFestival(): Collection
    {
        return $this->leFestival;
    }

    public function addLeFestival(festival $leFestival): static
    {
        if (!$this->leFestival->contains($leFestival)) {
            $this->leFestival->add($leFestival);
            $leFestival->setLesProgrammations($this);
        }

        return $this;
    }

    public function removeLeFestival(festival $leFestival): static
    {
        if ($this->leFestival->removeElement($leFestival)) {
            // set the owning side to null (unless already changed)
            if ($leFestival->getLesProgrammations() === $this) {
                $leFestival->setLesProgrammations(null);
            }
        }

        return $this;
    }

    public function createProgrammation(?Groupe $leGroupe, ?Groupe $leFestival, DateTime $leF): void
    {
        
    }

}
