<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MonRestaurantController extends AbstractController
{
    // private $security;
    // public function __construct(Security $security)
    // {
    //     $this->security = $security;
    // }

    private $repo;
    public function __construct(RestaurantRepository $repo)
    {
        $this->repo = $repo;
    }
    public function __invoke()
    {
         return $this->repo->findResto();
    //     $utilisateur = $this->security->getUser();

    //     $owners = $data->getPersonnel();

    //     foreach ($owners as $owner) {
    //         if ($utilisateur === $owner) {

    //             return $data;
    //         }
    //     };
         
     }
}



