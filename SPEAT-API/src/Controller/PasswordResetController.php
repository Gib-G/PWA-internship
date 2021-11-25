<?php

namespace App\Controller;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Routing\Annotation\Route;

class PasswordResetController extends AbstractController
{
    private $em;
    private $mailer;
    private $propertyAccessor;

    public function __construct(EntityManagerInterface $em, MailerInterface $mailer, PropertyAccessorInterface $propertyAccessor)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @Route("/api/forgot_password", name="forgot")
     */
    public function forgot(Request $request, UtilisateurRepository $repo)
    {

        $data = json_decode($request->getContent());

        $email = $this->propertyAccessor->getValue($data, 'Email');

        $user = $repo->findOneByEmail($email);

        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '=');

        if (!$user) {
            $error = new stdClass;
            $error->error = 'Aucun Utilisateur exciste avec le mail saisi';
            return new JsonResponse($error, 404);
        }
        $user->setPasswordResetToken($token);

        $this->em->persist($user);
        $this->em->flush($user);

        $mail = (new Email())
            ->from('contact@speat.fr')
            ->to($user->getEmail())
            ->subject('Réinitialisation de mot de passe')
            ->html("<a href='http://localhost:8000/api/reset/{$token}'>cliquez ici pour réinitialiser votre mot de passe</a>");

        $this->mailer->send($mail);

        return new JsonResponse('nous venons de vous envoyer un mail pour réinitialiser votre mot de passe');
    }
}
