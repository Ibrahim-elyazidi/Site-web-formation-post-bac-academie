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

    #[ORM\Column(length: 25)]
    private ?string $intituleFormation = null;

    #[ORM\Column]
    private ?int $dureeFormation = null;

    #[ORM\ManyToMany(targetEntity: Etablissement::class, mappedBy: 'formation')]
    private Collection $etablissement;

    #[ORM\ManyToMany(targetEntity: Referent::class, inversedBy: 'formation')]
    private Collection $referent;

    #[ORM\OneToMany(mappedBy: 'formation', targetEntity: FormationEtablissement::class)]
    private Collection $formationEtablissement;

    public function __construct()
    {
        $this->etablissement = new ArrayCollection();
        $this->referent = new ArrayCollection();
        $this->formationEtablissement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntituleFormation(): ?string
    {
        return $this->intituleFormation;
    }

    public function setIntituleFormation(string $intituleFormation): self
    {
        $this->intituleFormation = $intituleFormation;

        return $this;
    }

    public function getDureeFormation(): ?int
    {
        return $this->dureeFormation;
    }

    public function setDureeFormation(int $dureeFormation): self
    {
        $this->dureeFormation = $dureeFormation;

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

    /**
     * @return Collection<int, Referent>
     */
    public function getReferent(): Collection
    {
        return $this->referent;
    }

    public function addReferent(Referent $referent): self
    {
        if (!$this->referent->contains($referent)) {
            $this->referent->add($referent);
        }

        return $this;
    }

    public function removeReferent(Referent $referent): self
    {
        $this->referent->removeElement($referent);

        return $this;
    }

    /**
     * @return Collection<int, FormationEtablissement>
     */
    public function getFormationEtablissement(): Collection
    {
        return $this->formationEtablissement;
    }

    public function addFormationEtablissement(FormationEtablissement $formationEtablissement): self
    {
        if (!$this->formationEtablissement->contains($formationEtablissement)) {
            $this->formationEtablissement->add($formationEtablissement);
            $formationEtablissement->setFormation($this);
        }

        return $this;
    }

    public function removeFormationEtablissement(FormationEtablissement $formationEtablissement): self
    {
        if ($this->formationEtablissement->removeElement($formationEtablissement)) {
            // set the owning side to null (unless already changed)
            if ($formationEtablissement->getFormation() === $this) {
                $formationEtablissement->setFormation(null);
            }
        }

        return $this;
    }
}
