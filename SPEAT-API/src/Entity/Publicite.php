<?php

namespace App\Entity;

use App\Repository\PubliciteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PubliciteRepository::class)
 */
class Publicite extends Fichier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=TypePublicite::class)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="publicites")
     */
    private $restaurant;

    /**
     * @ORM\Column(type="float")
     */
    private $valeur;

    /**
     * @ORM\Column(type="integer")
     */
    private $nombreDeVues;

    public function __construct()
    {
        $this->type = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|TypePublicite[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(TypePublicite $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(TypePublicite $type): self
    {
        $this->type->removeElement($type);

        return $this;
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

    public function getValeur(): ?float
    {
        return $this->valeur;
    }

    public function setValeur(float $valeur): self
    {
        $this->valeur = $valeur;

        return $this;
    }

    public function getNombreDeVues(): ?int
    {
        return $this->nombreDeVues;
    }

    public function setNombreDeVues(int $nombreDeVues): self
    {
        $this->nombreDeVues = $nombreDeVues;

        return $this;
    }
}
