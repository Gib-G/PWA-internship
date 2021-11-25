<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Controller\MonCompteController;
use App\Repository\UtilisateurRepository;
use ApiPlatform\Core\Action\NotFoundAction;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UtilisateurRepository::class)
 * @ApiResource(
 *      attributes= {
 *      
 *      },
 * collectionOperations={
 *      "get"={
 *          "security"="is_granted('ROLE_ADMIN')",
 *          "openapi_context" = {
 *              "summary" = "Récupère tous les utilisateurs (ADMIN)",
 *              },
 *      },
 *      "post"={
 *          "openapi_context" = {
 *              "summary" = "Crée un utilisateur",
 *              },
 *      }
 *      
 *   },
 * itemOperations={
 *      "get"={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "openapi_context"={
 *                  "summary" = "Récupère un utilisateur (ADMIN)",
 *                  "security" = {"cookieAuth" = {""}},
 *                  }
 *              },
 *      "monCompte" = {
 *          "pagination_enabled" = false,
 *          "path" = "/moncompte",
 *          "method" = "get",
 *          "controller" = MonCompteController::class,
 *          "read" = false,
 *          "openapi_context" = {
 *              "summary" = "Récupère le compte de l'utilisateur connecté",
 *              "security" = {"cookieAuth" = {""}},
 *              }
 *          },

 *      "put"={
 *          "security"="is_granted('ROLE_ADMIN') or object == user",
 *          "openapi_context" = {
 *              "security" = {"cookieAuth" = {""}},
 *              "summary" = "Modifie un utilisateur (compte connecté / ADMIN)",
 *              }    
 *          },
 *      "delete"={
 *          "security"="is_granted('ROLE_ADMIN') or object == user",
 *          "openapi_context" = {
 *              "security" = {"cookieAuth" = {""}},
 *              "summary" = "Supprime un utilisateur (compte connecté / ADMIN)",
 *              }    
 *          },
 *      
 *      },
 * normalizationContext={"groups" = "read:user"},
 * denormalizationContext={"groups" = "write:user"}
 *      
 *     
 * )
 */
class Utilisateur implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:user","write:user"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"read:user","write:user"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read:user","write:user"})
     */
    private $roles = [];

    /**
     * @SerializedName("password")
     * @Groups("write:user")
     */
    private $plainPassword;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:user","write:user"})
     */
    private $pseudo;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:user","write:user"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read:user","write:user"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read:user","write:user"})
     */
    private $telephone;
    
    /**
     * @ORM\ManyToMany(targetEntity=Adresse::class, inversedBy="utilisateurs",cascade={"persist"})
     * @Groups({"read:user","write:user"})
     */
    private $adresse;

    /**
     * @ORM\ManyToMany(targetEntity=Image::class)
     */
    private $galerie;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $produitsFavoris;

    /**
     * @ORM\ManyToMany(targetEntity=Restaurant::class)
     */
    private $restaurantsFavoris;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $confirmationToken;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $PasswordResetToken;


    public function __construct()
    {
        $this->adresse = new ArrayCollection();
        $this->galerie = new ArrayCollection();
        $this->produitsFavoris = new ArrayCollection();
        $this->restaurantsFavoris = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(?string $pseudo): self
    {
        $this->pseudo = $pseudo;

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

    /**
     * @return Collection|Image[]
     */
    public function getGalerie(): Collection
    {
        return $this->galerie;
    }

    public function addGalerie(Image $galerie): self
    {
        if (!$this->galerie->contains($galerie)) {
            $this->galerie[] = $galerie;
        }

        return $this;
    }

    public function removeGalerie(Image $galerie): self
    {
        $this->galerie->removeElement($galerie);

        return $this;
    }

    /**
     * @return Collection|Produit[]
     */
    public function getProduitsFavoris(): Collection
    {
        return $this->produitsFavoris;
    }

    public function addProduitsFavori(Produit $produitsFavori): self
    {
        if (!$this->produitsFavoris->contains($produitsFavori)) {
            $this->produitsFavoris[] = $produitsFavori;
        }

        return $this;
    }

    public function removeProduitsFavori(Produit $produitsFavori): self
    {
        $this->produitsFavoris->removeElement($produitsFavori);

        return $this;
    }

    /**
     * @return Collection|Restaurant[]
     */
    public function getRestaurantsFavoris(): Collection
    {
        return $this->restaurantsFavoris;
    }

    public function addRestaurantsFavori(Restaurant $restaurantsFavori): self
    {
        if (!$this->restaurantsFavoris->contains($restaurantsFavori)) {
            $this->restaurantsFavoris[] = $restaurantsFavori;
        }

        return $this;
    }

    public function removeRestaurantsFavori(Restaurant $restaurantsFavori): self
    {
        $this->restaurantsFavoris->removeElement($restaurantsFavori);

        return $this;
    }

    /**
     * Get the value of plainPassword
     */ 
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * Set the value of plainPassword
     *
     * @return  self
     */ 
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection|Adresse[]
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(Adresse $adresse): self
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse[] = $adresse;
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): self
    {
        $this->adresse->removeElement($adresse);

        return $this;
    }

    public function getConfirmationToken(): ?string
    {
        return $this->confirmationToken;
    }

    public function setConfirmationToken(?string $confirmationToken): self
    {
        $this->confirmationToken = $confirmationToken;

        return $this;
    }

    public function getPasswordResetToken(): ?string
    {
        return $this->PasswordResetToken;
    }

    public function setPasswordResetToken(?string $PasswordResetToken): self
    {
        $this->PasswordResetToken = $PasswordResetToken;

        return $this;
    }
}
