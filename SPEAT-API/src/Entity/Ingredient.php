<?php

namespace App\Entity;

use App\Repository\IngredientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IngredientRepository::class)
 */
class Ingredient extends Consommable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantiteMax;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="options")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\OneToMany(targetEntity=PrixIngredient::class, mappedBy="ingredient", orphanRemoval=true)
     */
    private $prixUnitaire;

    /**
     * @ORM\ManyToMany(targetEntity=Image::class)
     */
    private $illustration;

    /**
     * @ORM\ManyToMany(targetEntity=Disponibilite::class)
     */
    private $disponibilites;

    public function __construct()
    {
        $this->prixUnitaire = new ArrayCollection();
        $this->illustration = new ArrayCollection();
        $this->disponibilites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantiteMax(): ?int
    {
        return $this->quantiteMax;
    }

    public function setQuantiteMax(int $quantiteMax): self
    {
        $this->quantiteMax = $quantiteMax;

        return $this;
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

    /**
     * @return Collection|PrixIngredient[]
     */
    public function getPrixUnitaire(): Collection
    {
        return $this->prixUnitaire;
    }

    public function addPrixUnitaire(PrixIngredient $prixUnitaire): self
    {
        if (!$this->prixUnitaire->contains($prixUnitaire)) {
            $this->prixUnitaire[] = $prixUnitaire;
            $prixUnitaire->setIngredient($this);
        }

        return $this;
    }

    public function removePrixUnitaire(PrixIngredient $prixUnitaire): self
    {
        if ($this->prixUnitaire->removeElement($prixUnitaire)) {
            // set the owning side to null (unless already changed)
            if ($prixUnitaire->getIngredient() === $this) {
                $prixUnitaire->setIngredient(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getIllustration(): Collection
    {
        return $this->illustration;
    }

    public function addIllustration(Image $illustration): self
    {
        if (!$this->illustration->contains($illustration)) {
            $this->illustration[] = $illustration;
        }

        return $this;
    }

    public function removeIllustration(Image $illustration): self
    {
        $this->illustration->removeElement($illustration);

        return $this;
    }

    /**
     * @return Collection|Disponibilite[]
     */
    public function getDisponibilites(): Collection
    {
        return $this->disponibilites;
    }

    public function addDisponibilite(Disponibilite $disponibilite): self
    {
        if (!$this->disponibilites->contains($disponibilite)) {
            $this->disponibilites[] = $disponibilite;
        }

        return $this;
    }

    public function removeDisponibilite(Disponibilite $disponibilite): self
    {
        $this->disponibilites->removeElement($disponibilite);

        return $this;
    }
}
