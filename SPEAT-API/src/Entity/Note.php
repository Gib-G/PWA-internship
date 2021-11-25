<?php

namespace App\Entity;

use App\Repository\NoteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoteRepository::class)
 */
class Note
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     */
    private $utilisateur;

    /**
     * @ORM\ManyToOne(targetEntity=Produit::class, inversedBy="notes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteGout;

    /**
     * @ORM\Column(type="integer")
     */
    private $notePresentation;

    /**
     * @ORM\Column(type="integer")
     */
    private $noteQuantite;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUtilisateur(): ?Utilisateur
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?Utilisateur $utilisateur): self
    {
        $this->utilisateur = $utilisateur;

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

    public function getNoteGout(): ?int
    {
        return $this->noteGout;
    }

    public function setNoteGout(int $noteGout): self
    {
        $this->noteGout = $noteGout;

        return $this;
    }

    public function getNotePresentation(): ?int
    {
        return $this->notePresentation;
    }

    public function setNotePresentation(int $notePresentation): self
    {
        $this->notePresentation = $notePresentation;

        return $this;
    }

    public function getNoteQuantite(): ?int
    {
        return $this->noteQuantite;
    }

    public function setNoteQuantite(int $noteQuantite): self
    {
        $this->noteQuantite = $noteQuantite;

        return $this;
    }
}
