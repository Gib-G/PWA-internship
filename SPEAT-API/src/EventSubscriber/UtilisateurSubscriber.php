<?php

namespace App\EventSubscriber;

use App\Entity\Utilisateur;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use ApiPlatform\Core\EventListener\EventPriorities;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

final class UtilisateurSubscriber implements EventSubscriberInterface
{
    private $mailer;
    private $em;

    public function __construct(MailerInterface $mailer, EntityManagerInterface $em)
    {
        $this->mailer = $mailer;
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendConfirmation', EventPriorities::POST_WRITE],
        ];
    }
    public function sendConfirmation(ViewEvent $event): void
    
    {
        $user = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();


        if (!$user instanceof Utilisateur || Request::METHOD_POST !== $method) {
            return;
        }

        $token = rtrim(strtr(base64_encode(random_bytes(32)), '+/','-_'), '=');

        $user->setConfirmationToken($token);
        $this->em->persist($user);
        $this->em->flush($user);

        $mail = (new Email())
            ->from('contact@speat.fr')
            ->to($user->getEmail())
            ->subject('Confirmation de compte')
            ->html("<a href='http://localhost:8000/confirm/{$token}'>cliquez ici pour verifier votre compte</a>");

            $this->mailer->send($mail);
    }
}