<?php

namespace App\Entity;

use App\Repository\EnregistrementRestaurantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EnregistrementRestaurantRepository::class)
 */
class EnregistrementRestaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomRestaurant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionRestaurant;

    /**
     * @ORM\Column(type="integer")
     */
    private $siretRestaurant;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Document::class, mappedBy="dossier", orphanRemoval=true)
     */
    private $justificatifs;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $demandeur;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $adresseRestaurant;

    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class)
     */
    private $personnelRestaurant;

    public function __construct()
    {
        $this->justificatifs = new ArrayCollection();
        $this->personnelRestaurant = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomRestaurant(): ?string
    {
        return $this->nomRestaurant;
    }

    public function setNomRestaurant(string $nomRestaurant): self
    {
        $this->nomRestaurant = $nomRestaurant;

        return $this;
    }

    public function getDescriptionRestaurant(): ?string
    {
        return $this->descriptionRestaurant;
    }

    public function setDescriptionRestaurant(?string $descriptionRestaurant): self
    {
        $this->descriptionRestaurant = $descriptionRestaurant;

        return $this;
    }

    public function getSiretRestaurant(): ?int
    {
        return $this->siretRestaurant;
    }

    public function setSiretRestaurant(int $siretRestaurant): self
    {
        $this->siretRestaurant = $siretRestaurant;

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

    /**
     * @return Collection|Document[]
     */
    public function getJustificatifs(): Collection
    {
        return $this->justificatifs;
    }

    public function addJustificatif(Document $justificatif): self
    {
        if (!$this->justificatifs->contains($justificatif)) {
            $this->justificatifs[] = $justificatif;
            $justificatif->setDossier($this);
        }

        return $this;
    }

    public function removeJustificatif(Document $justificatif): self
    {
        if ($this->justificatifs->removeElement($justificatif)) {
            // set the owning side to null (unless already changed)
            if ($justificatif->getDossier() === $this) {
                $justificatif->setDossier(null);
            }
        }

        return $this;
    }

    public function getDemandeur(): ?Utilisateur
    {
        return $this->demandeur;
    }

    public function setDemandeur(?Utilisateur $demandeur): self
    {
        $this->demandeur = $demandeur;

        return $this;
    }

    public function getAdresseRestaurant(): ?Adresse
    {
        return $this->adresseRestaurant;
    }

    public function setAdresseRestaurant(?Adresse $adresseRestaurant): self
    {
        $this->adresseRestaurant = $adresseRestaurant;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getPersonnelRestaurant(): Collection
    {
        return $this->personnelRestaurant;
    }

    public function addPersonnelRestaurant(Utilisateur $personnelRestaurant): self
    {
        if (!$this->personnelRestaurant->contains($personnelRestaurant)) {
            $this->personnelRestaurant[] = $personnelRestaurant;
        }

        return $this;
    }

    public function removePersonnelRestaurant(Utilisateur $personnelRestaurant): self
    {
        $this->personnelRestaurant->removeElement($personnelRestaurant);

        return $this;
    }
}
