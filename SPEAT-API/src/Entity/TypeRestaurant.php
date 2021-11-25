<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TypeRestaurantRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypeRestaurantRepository::class)
 * @ApiResource(
 *   itemOperations={
 *           "get"={
 *              "openapi_context"={
 *                  "summary" = "Récupère un TypeRestaurant"
 *                  }
 *                  },
 *           "delete"={
 *                  "security" = "is_granted('ROLE_ADMIN')",
 *                                                                                                                                                                                                                                                                "openapi_context"={
 *                      "security" = {"cookieAuth" = {""}},
 *                       "summary" = "Supprime un TypeRestaurant (ADMIN)",
 *                                   }
 *                  },
 *           "put"={
 *                  "security" = "is_granted('ROLE_ADMIN')",
 *                                                                                                                                                                                                                                                                "openapi_context"={
 *                      "security" = {"cookieAuth" = {""}},
 *                       "summary" = "Modifie un TypeRestaurant (ADMIN)",
 *                                   }
 *                  },
 *              },
 *   collectionOperations={
 *          "get"={
 *              "openapi_context"={
 *                  "summary" = "Récupère tous les  TypeRestaurant"
 *                  }
 *                  },
 *           "post"={
 *                  "security" = "is_granted('ROLE_ADMIN')",
 *                  "openapi_context"={
 *                      "security" = {"cookieAuth" = {""}},
 *                       "summary" = "Crée un TypeRestaurant (ADMIN)",
 *                                   }
 *                  },
 *                }
 * )
 */
class TypeRestaurant
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
}