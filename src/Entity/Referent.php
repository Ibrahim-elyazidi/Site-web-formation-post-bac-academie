<?php

namespace App\Entity;

use App\Repository\ReferentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferentRepository::class)]
class Referent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nomReferent = null;

    #[ORM\Column(length: 30)]
    private ?string $prenomReferent = null;

    #[ORM\Column(length: 35)]
    private ?string $mailReferent = null;

    #[ORM\Column(length: 10)]
    private ?string $telephoneReferent = null;

    #[ORM\ManyToOne(inversedBy: 'referent')]
    private ?Etablissement $etablissement = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, mappedBy: 'referent')]
    private Collection $formation;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomReferent(): ?string
    {
        return $this->nomReferent;
    }

    public function setNomReferent(string $nomReferent): self
    {
        $this->nomReferent = $nomReferent;

        return $this;
    }

    public function getPrenomReferent(): ?string
    {
        return $this->prenomReferent;
    }

    public function setPrenomReferent(string $prenomReferent): self
    {
        $this->prenomReferent = $prenomReferent;

        return $this;
    }

    public function getMailReferent(): ?string
    {
        return $this->mailReferent;
    }

    public function setMailReferent(string $mailReferent): self
    {
        $this->mailReferent = $mailReferent;

        return $this;
    }

    public function getTelephoneReferent(): ?string
    {
        return $this->telephoneReferent;
    }

    public function setTelephoneReferent(string $telephoneReferent): self
    {
        $this->telephoneReferent = $telephoneReferent;

        return $this;
    }

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection<int, Formation>
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(Formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation->add($formation);
            $formation->addReferent($this);
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        if ($this->formation->removeElement($formation)) {
            $formation->removeReferent($this);
        }

        return $this;
    }
}
