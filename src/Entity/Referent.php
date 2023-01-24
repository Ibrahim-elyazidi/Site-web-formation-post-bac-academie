<?php

namespace App\Entity;

use App\Repository\ReferentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReferentRepository::class)]
class Referent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nomRef = null;

    #[ORM\Column(length: 50)]
    private ?string $prenomRef = null;

    #[ORM\Column(length: 50)]
    private ?string $adresseRef = null;

    #[ORM\Column(length: 10)]
    private ?string $telephoneRef = null;

    #[ORM\ManyToOne(inversedBy: 'referent')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Etablissement $etablissement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRef(): ?string
    {
        return $this->nomRef;
    }

    public function setNomRef(string $nomRef): self
    {
        $this->nomRef = $nomRef;

        return $this;
    }

    public function getPrenomRef(): ?string
    {
        return $this->prenomRef;
    }

    public function setPrenomRef(string $prenomRef): self
    {
        $this->prenomRef = $prenomRef;

        return $this;
    }

    public function getAdresseRef(): ?string
    {
        return $this->adresseRef;
    }

    public function setAdresseRef(string $adresseRef): self
    {
        $this->adresseRef = $adresseRef;

        return $this;
    }

    public function getTelephoneRef(): ?string
    {
        return $this->telephoneRef;
    }

    public function setTelephoneRef(string $telephoneRef): self
    {
        $this->telephoneRef = $telephoneRef;

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
}
