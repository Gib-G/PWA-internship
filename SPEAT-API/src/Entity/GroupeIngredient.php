<?php

namespace App\Entity;

use App\Repository\GroupeIngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeIngredientRepository::class)
 */
class GroupeIngredient extends Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity=GroupeIngredient::class, inversedBy="groupes")
     */
    private $groupeParent;

    /**
     * @ORM\OneToMany(targetEntity=GroupeIngredient::class, mappedBy="groupeParent")
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class)
     */
    private $ingredients;

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->ingredients = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProduit(): ?Produit
    {
        return $this->produit;
    }

    public function setProduit(?Produit $produit): self
    {
        $this->produit = $produit;

        return $this;
    }

    public function getGroupeParent(): ?self
    {
        return $this->groupeParent;
    }

    public function setGroupeParent(?self $groupeParent): self
    {
        $this->groupeParent = $groupeParent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getGroupes(): Collection
    {
        return $this->groupes;
    }

    public function addGroupe(self $groupe): self
    {
        if (!$this->groupes->contains($groupe)) {
            $this->groupes[] = $groupe;
            $groupe->setGroupeParent($this);
        }

        return $this;
    }

    public function removeGroupe(self $groupe): self
    {
        if ($this->groupes->removeElement($groupe)) {
            // set the owning side to null (unless already changed)
            if ($groupe->getGroupeParent() === $this) {
                $groupe->setGroupeParent(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredients->removeElement($ingredient);

        return $this;
    }
}
