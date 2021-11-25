<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="api_login", methods={"POST"})
     */
    public function login()
    {
        $utilisateur = $this->getUser();
        if($utilisateur->getConfirmationToken() !== null){
            throw $this->createNotFoundException('Compte non confirmé');
            return;
        }
        return $this->json([
            'username' => $utilisateur->getUsername(),
            'roles' => $utilisateur->getRoles(),
        ]);
    }

    /**
     * @Route("/logout", name="api_logout", methods={"POST"})
     */
    public function logout()
    {

    }
}
