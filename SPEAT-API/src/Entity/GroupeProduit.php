<?php

namespace App\Entity;

use App\Repository\GroupeProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupeProduitRepository::class)
 */
class GroupeProduit extends Groupe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="menu")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurant;

    /**
     * @ORM\ManyToOne(targetEntity=GroupeProduit::class, inversedBy="groupes")
     */
    private $groupeParent;

    /**
     * @ORM\OneToMany(targetEntity=GroupeProduit::class, mappedBy="groupeParent")
     */
    private $groupes;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $produits;

   

    public function __construct()
    {
        $this->groupes = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

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
     * @return Collection|Produit[]
     */
    public function getProduits(): Collection
    {
        return $this->produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->produits->contains($produit)) {
            $this->produits[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->produits->removeElement($produit);

        return $this;
    }

    



}
