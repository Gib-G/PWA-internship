<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ConfirmationController extends AbstractController
{
    private $em ;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/confirm/{token}", name="confirm")
     */
    public function confirm($token, UtilisateurRepository $repo)
    {
      $user = $repo->findOneBy(['confirmationToken' => $token]);

      if(!$user){
         throw $this->createNotFoundException('Not Found');
      }
      $user->setConfirmationToken(null);
      $this->em->persist($user);
      $this->em->flush($user);

      $this->addFlash('message','votre compte a bien été activé');
      return $this->redirect('http://symfony.com/doc');
    }
}