<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RestaurantRepository;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Controller\MonRestaurantController;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource(
 *      attributes={
 *               "order"={"sponsorise":"DESC"},
 *      },
 *      collectionOperations={
 *          "get"={
 *              "openapi_context"={
 *                  "summary" = "Récupère tous les restaurants"
 *                  }
 *              },
 *         "monRestaurant" = {
 *                   "path" = "/monrestaurant",
 *                   "method" = "get",
 *                   "controller" = MonRestaurantController::class,
 *                   "read" = false,
 *              "openapi_context" = {
 *                  "summary" = "Récupère les restaurants associé au compte utilisateur",
 *                  },
 *          },
 *          "post"={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "openapi_context" = {
 *                  "summary" = "Crée un restaurant (ADMIN)",
 *                  },
 *              },    
 *      },
 *      itemOperations={
 *          "get"={
 *              "openapi_context"={
 *                  "summary" = "Récupère un restaurant"
 *                  }
 *              },
 *           "put"={
 *               "security"="is_granted('restaurant_edit', object)",
 *               "openapi_context" = {
 *                  "security" = {"cookieAuth" = {""}},
 *                  "summary" = "Modifie un restaurant (compte restaurateur connecté / ADMIN)",
 *                  }    
 *              },
 *           "delete"={
 *               "security"="is_granted('restaurant_edit', object)",
 *               "openapi_context" = {
 *                  "security" = {"cookieAuth" = {""}},
 *                  "summary" = "Supprime un restaurant (compte restaurateur connecté / ADMIN)",
 *                  }    
 *              },
 *              
 *      },
 *      paginationItemsPerPage=20,
 *      denormalizationContext={"groups"="restaurant:write"}    
 *      
 * )
 * @ApiFilter(
 *   SearchFilter::class, properties={"types" = "exact", "nom" = "partial"}
 * )
 * @ORM\Entity(repositoryClass=RestaurantRepository::class)
 */
class Restaurant
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("restaurant:write")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups("restaurant:write")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=PlageHoraire::class, mappedBy="restaurant", orphanRemoval=true)
     */
    private $horaires;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $siret;

    /**
     * @ORM\ManyToMany(targetEntity=TypeRestaurant::class,cascade={"persist"})
     * @Groups("restaurant:write")
     */
    private $types;

    /**
     * @ORM\OneToMany(targetEntity=GroupeProduit::class, mappedBy="restaurant", orphanRemoval=true)
     */
    private $menu;

    /**
     * @ORM\OneToMany(targetEntity=Publicite::class, mappedBy="restaurant")
     */
    private $publicites;

    /**
     * @ORM\OneToMany(targetEntity=RedirectionRestaurant::class, mappedBy="restaurant", orphanRemoval=true)
     */
    private $redirections;

    /**
     * @ORM\ManyToMany(targetEntity=Image::class)
     */
    private $illustration;

    /**
     * @ORM\ManyToMany(targetEntity=Disponibilite::class)
     */
    private $disponibilites;


    /**
     * @ORM\ManyToMany(targetEntity=Utilisateur::class)
     */
    private $personnel;

    /**
     * @ORM\ManyToOne(targetEntity=Adresse::class,cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @Groups("restaurant:write")
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity=Commande::class, mappedBy="restaurant", orphanRemoval=true)
     */
    private $commandes;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $vues;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $recherches;

    /**
     * @ORM\Column(type="integer",nullable=true, options={"default":0})
     */
    private $sponsorise;


    public function __construct()
    {
        $this->horaires = new ArrayCollection();
        $this->types = new ArrayCollection();
        $this->menu = new ArrayCollection();
        $this->publicites = new ArrayCollection();
        $this->redirections = new ArrayCollection();
        $this->illustration = new ArrayCollection();
        $this->disponibilites = new ArrayCollection();
        $this->personnel = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|PlageHoraire[]
     */
    public function getHoraires(): Collection
    {
        return $this->horaires;
    }

    public function addHoraire(PlageHoraire $horaire): self
    {
        if (!$this->horaires->contains($horaire)) {
            $this->horaires[] = $horaire;
            $horaire->setRestaurant($this);
        }

        return $this;
    }

    public function removeHoraire(PlageHoraire $horaire): self
    {
        if ($this->horaires->removeElement($horaire)) {
            // set the owning side to null (unless already changed)
            if ($horaire->getRestaurant() === $this) {
                $horaire->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getSiret(): ?int
    {
        return $this->siret;
    }

    public function setSiret(int $siret): self
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * @return Collection|TypeRestaurant[]
     */
    public function getTypes(): Collection
    {
        return $this->types;
    }

    public function addType(TypeRestaurant $type): self
    {
        if (!$this->types->contains($type)) {
            $this->types[] = $type;
        }

        return $this;
    }

    public function removeType(TypeRestaurant $type): self
    {
        $this->types->removeElement($type);

        return $this;
    }

    /**
     * @return Collection|GroupeProduit[]
     */
    public function getMenu(): Collection
    {
        return $this->menu;
    }

    public function addMenu(GroupeProduit $menu): self
    {
        if (!$this->menu->contains($menu)) {
            $this->menu[] = $menu;
            $menu->setRestaurant($this);
        }

        return $this;
    }

    public function removeMenu(GroupeProduit $menu): self
    {
        if ($this->menu->removeElement($menu)) {
            // set the owning side to null (unless already changed)
            if ($menu->getRestaurant() === $this) {
                $menu->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publicite[]
     */
    public function getPublicites(): Collection
    {
        return $this->publicites;
    }

    public function addPublicite(Publicite $publicite): self
    {
        if (!$this->publicites->contains($publicite)) {
            $this->publicites[] = $publicite;
            $publicite->setRestaurant($this);
        }

        return $this;
    }

    public function removePublicite(Publicite $publicite): self
    {
        if ($this->publicites->removeElement($publicite)) {
            // set the owning side to null (unless already changed)
            if ($publicite->getRestaurant() === $this) {
                $publicite->setRestaurant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RedirectionRestaurant[]
     */
    public function getRedirections(): Collection
    {
        return $this->redirections;
    }

    public function addRedirection(RedirectionRestaurant $redirection): self
    {
        if (!$this->redirections->contains($redirection)) {
            $this->redirections[] = $redirection;
            $redirection->setRestaurant($this);
        }

        return $this;
    }

    public function removeRedirection(RedirectionRestaurant $redirection): self
    {
        if ($this->redirections->removeElement($redirection)) {
            // set the owning side to null (unless already changed)
            if ($redirection->getRestaurant() === $this) {
                $redirection->setRestaurant(null);
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


    public function getAdresse(): ?Adresse
    {
        return $this->adresse;
    }

    public function setAdresse(?Adresse $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getPersonnel(): Collection
    {
        return $this->personnel;
    }

    public function addPersonnel(Utilisateur $personnel): self
    {
        if (!$this->personnel->contains($personnel)) {
            $this->personnel[] = $personnel;
        }

        return $this;
    }

    public function removePersonnel(Utilisateur $personnel): self
    {
        $this->personnel->removeElement($personnel);

        return $this;
    }

   
    /**
     * @return Collection|Commande[]
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setRestaurant($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getRestaurant() === $this) {
                $commande->setRestaurant(null);
            }
        }

        return $this;
    }

    public function getVues(): ?int
    {
        return $this->vues;
    }

    public function setVues(?int $vues): self
    {
        $this->vues = $vues;

        return $this;
    }

    public function getRecherches(): ?int
    {
        return $this->recherches;
    }

    public function setRecherches(?int $recherches): self
    {
        $this->recherches = $recherches;

        return $this;
    }

    public function getSponsorise(): ?int
    {
        return $this->sponsorise;
    }

    public function setSponsorise(int $sponsorise): self
    {
        $this->sponsorise = $sponsorise;

        return $this;
    }

   
}
