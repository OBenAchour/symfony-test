<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitsRepository::class)]
class Produits
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column]
    private ?int $nb_produits = null;

    #[ORM\Column]
    private ?int $jaime = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date_fa = null;

    #[ORM\ManyToOne(inversedBy: 'produit')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Categorie $categorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNbProduits(): ?int
    {
        return $this->nb_produits;
    }

    public function setNbProduits(int $nb_produits): static
    {
        $this->nb_produits = $nb_produits;

        return $this;
    }

    public function getJaime(): ?int
    {
        return $this->jaime;
    }

    public function setJaime(int $jaime): static
    {
        $this->jaime = $jaime;

        return $this;
    }

    public function getDateFa(): ?\DateTimeInterface
    {
        return $this->date_fa;
    }

    public function setDateFa(\DateTimeInterface $date_fa): static
    {
        $this->date_fa = $date_fa;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
