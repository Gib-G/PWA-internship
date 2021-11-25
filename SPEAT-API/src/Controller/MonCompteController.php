<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;

class MonCompteController extends AbstractController
{
    private $security;
    public function __construct(Security $security ) {
        $this->security = $security;
    }

    public function __invoke(){
        $utilisateur = $this->security->getUser();
        return $utilisateur;
    }
}