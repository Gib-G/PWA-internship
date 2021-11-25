<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $reference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $moyenDePaiement;

    /**
     * @ORM\ManyToMany(targetEntity=Disponibilite::class)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroDeTable;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $produits;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $indicationsRestaurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $indicationsLivreur;

    public function __construct()
    {
        $this->type = new ArrayCollection();
        $this->produits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getMoyenDePaiement(): ?string
    {
        return $this->moyenDePaiement;
    }

    public function setMoyenDePaiement(?string $moyenDePaiement): self
    {
        $this->moyenDePaiement = $moyenDePaiement;

        return $this;
    }

    /**
     * @return Collection|Disponibilite[]
     */
    public function getType(): Collection
    {
        return $this->type;
    }

    public function addType(Disponibilite $type): self
    {
        if (!$this->type->contains($type)) {
            $this->type[] = $type;
        }

        return $this;
    }

    public function removeType(Disponibilite $type): self
    {
        $this->type->removeElement($type);

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

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

    public function getNumeroDeTable(): ?string
    {
        return $this->numeroDeTable;
    }

    public function setNumeroDeTable(?string $numeroDeTable): self
    {
        $this->numeroDeTable = $numeroDeTable;

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

    public function getIndicationsRestaurant(): ?string
    {
        return $this->indicationsRestaurant;
    }

    public function setIndicationsRestaurant(?string $indicationsRestaurant): self
    {
        $this->indicationsRestaurant = $indicationsRestaurant;

        return $this;
    }

    public function getIndicationsLivreur(): ?string
    {
        return $this->indicationsLivreur;
    }

    public function setIndicationsLivreur(?string $indicationsLivreur): self
    {
        $this->indicationsLivreur = $indicationsLivreur;

        return $this;
    }
}
