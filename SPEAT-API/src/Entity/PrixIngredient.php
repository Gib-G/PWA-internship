<?php

namespace App\Entity;

use App\Repository\PrixIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrixIngredientRepository::class)
 */
class PrixIngredient
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\ManyToMany(targetEntity=TypePrix::class)
     */
    private $types;

    /**
     * @ORM\ManyToOne(targetEntity=Ingredient::class, inversedBy="prixUnitaire")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ingredient;

    public function __construct()
    {
        $this->types = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    /**
     * @return Collection|TypePrix[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypePrix $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(TypePrix $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getIngredient(): ?Ingredient
    {
        return $this->ingredient;
    }

    public function setIngredient(?Ingredient $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }
}
