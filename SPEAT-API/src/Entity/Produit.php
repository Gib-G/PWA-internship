<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProduitRepository::class)
 */
class Produit extends Consommable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=TypeProduit::class)
     */
    private $types;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $composition;

    /**
     * @ORM\OneToMany(targetEntity=RedirectionProduit::class, mappedBy="produit")
     */
    private $redirections;

    /**
     * @ORM\OneToMany(targetEntity=PrixProduit::class, mappedBy="produit", orphanRemoval=true)
     */
    private $prixUnitaire;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="produit", orphanRemoval=true)
     */
    private $options;

    /**
     * @ORM\ManyToMany(targetEntity=Image::class)
     */
    private $illustration;

    /**
     * @ORM\ManyToMany(targetEntity=Disponibilite::class)
     */
    private $disponibilites;

    /**
     * @ORM\OneToMany(targetEntity=Note::class, mappedBy="produit", orphanRemoval=true)
     */
    private $notes;

    public function __construct()
    {
        $this->types = new ArrayCollection();
        $this->redirections = new ArrayCollection();
        $this->prixUnitaire = new ArrayCollection();
        $this->options = new ArrayCollection();
        $this->illustration = new ArrayCollection();
        $this->disponibilites = new ArrayCollection();
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|TypeProduit[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeProduit $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(TypeProduit $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(?string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    /**
     * @return Collection|RedirectionProduit[]
     */
    public function getRedirections(): Collection
    {
        return $this->redirections;
    }

    public function addRedirection(RedirectionProduit $redirection): self
    {
        if (!$this->redirections->contains($redirection)) {
            $this->redirections[] = $redirection;
            $redirection->setProduit($this);
        }

        return $this;
    }

    public function removeRedirection(RedirectionProduit $redirection): self
    {
        if ($this->redirections->removeElement($redirection)) {
            // set the owning side to null (unless already changed)
            if ($redirection->getProduit() === $this) {
                $redirection->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|PrixProduit[]
     */
    public function getPrixUnitaire(): Collection
    {
        return $this->prixUnitaire;
    }

    public function addPrixUnitaire(PrixProduit $prixUnitaire): self
    {
        if (!$this->prixUnitaire->contains($prixUnitaire)) {
            $this->prixUnitaire[] = $prixUnitaire;
            $prixUnitaire->setProduit($this);
        }

        return $this;
    }

    public function removePrixUnitaire(PrixProduit $prixUnitaire): self
    {
        if ($this->prixUnitaire->removeElement($prixUnitaire)) {
            // set the owning side to null (unless already changed)
            if ($prixUnitaire->getProduit() === $this) {
                $prixUnitaire->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    public function addOption(Ingredient $option): self
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $option->setProduit($this);
        }

        return $this;
    }

    public function removeOption(Ingredient $option): self
    {
        if ($this->options->removeElement($option)) {
            // set the owning side to null (unless already changed)
            if ($option->getProduit() === $this) {
                $option->setProduit(null);
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

    /**
     * @return Collection|Note[]
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): self
    {
        if (!$this->notes->contains($note)) {
            $this->notes[] = $note;
            $note->setProduit($this);
        }

        return $this;
    }

    public function removeNote(Note $note): self
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getProduit() === $this) {
                $note->setProduit(null);
            }
        }

        return $this;
    }
}
