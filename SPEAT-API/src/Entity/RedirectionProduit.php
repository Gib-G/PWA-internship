<?php

namespace App\Entity;

use App\Repository\RedirectionProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RedirectionProduitRepository::class)
 */
class RedirectionProduit extends Redirection
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="redirections")
     */
    private $produit;

    /**
     * @ORM\ManyToMany(targetEntity=TypeRedirection::class)
     */
    private $types;

    public function __construct()
    {
        $this->types = new ArrayCollection();
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

    /**
     * @return Collection|TypeRedirection[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeRedirection $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(TypeRedirection $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }
}
