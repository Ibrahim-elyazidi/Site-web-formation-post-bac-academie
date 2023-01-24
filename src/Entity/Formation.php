<?php

namespace App\Entity;

use App\Repository\FormationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormationRepository::class)]
class Formation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $intitule = null;

    #[ORM\Column]
    private ?int $duree = null;

    #[ORM\ManyToMany(targetEntity: Etablissement::class, mappedBy: 'formation')]
    private Collection $etablissement;

    public function __construct()
    {
        $this->etablissement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDuree(): ?int
    {
        return $this->duree;
    }

    public function setDuree(int $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * @return Collection<int, Etablissement>
     */
    public function getEtablissement(): Collection
    {
        return $this->etablissement;
    }

    public function addEtablissement(Etablissement $etablissement): self
    {
        if (!$this->etablissement->contains($etablissement)) {
            $this->etablissement->add($etablissement);
            $etablissement->addFormation($this);
        }

        return $this;
    }

    public function removeEtablissement(Etablissement $etablissement): self
    {
        if ($this->etablissement->removeElement($etablissement)) {
            $etablissement->removeFormation($this);
        }

        return $this;
    }
}
