<?php

namespace App\Entity;

use App\Repository\DocumentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DocumentRepository::class)
 */
class Document extends Fichier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=EnregistrementRestaurant::class, inversedBy="justificatifs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossier(): ?EnregistrementRestaurant
    {
        return $this->dossier;
    }

    public function setDossier(?EnregistrementRestaurant $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }
}
