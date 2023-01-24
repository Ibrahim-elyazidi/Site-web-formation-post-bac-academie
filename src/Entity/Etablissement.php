<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtablissementRepository::class)]
class Etablissement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 115)]
    private ?string $nomEtablissement = null;

    #[ORM\Column(length: 145)]
    private ?string $adresseEtablissement = null;

    #[ORM\Column(length: 10)]
    private ?string $telephoneEtablissement = null;

    #[ORM\ManyToOne(inversedBy: 'etablissement')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Departement $departement = null;

    #[ORM\ManyToMany(targetEntity: Formation::class, inversedBy: 'etablissement')]
    private Collection $formation;

    #[ORM\OneToMany(mappedBy: 'etablissement', targetEntity: Referent::class)]
    private Collection $referent;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
        $this->referent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {
        $this->nomEtablissement = $nomEtablissement;

        return $this;
    }

    public function getAdresseEtablissement(): ?string
    {
        return $this->adresseEtablissement;
    }

    public function setAdresseEtablissement(string $adresseEtablissement): self
    {
        $this->adresseEtablissement = $adresseEtablissement;

        return $this;
    }

    public function getTelephoneEtablissement(): ?string
    {
        return $this->telephoneEtablissement;
    }

    public function setTelephoneEtablissement(string $telephoneEtablissement): self
    {
        $this->telephoneEtablissement = $telephoneEtablissement;

        return $this;
    }

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

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
        }

        return $this;
    }

    public function removeFormation(Formation $formation): self
    {
        $this->formation->removeElement($formation);

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
            $referent->setEtablissement($this);
        }

        return $this;
    }

    public function removeReferent(Referent $referent): self
    {
        if ($this->referent->removeElement($referent)) {
            // set the owning side to null (unless already changed)
            if ($referent->getEtablissement() === $this) {
                $referent->setEtablissement(null);
            }
        }

        return $this;
    }
}
