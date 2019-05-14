<?php

namespace App\Services;

use App\Entity\{User, Notification};
use App\Repository\NotificationRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NotificationService
{
    private $em;

    private $tokenStorage;

    private $session;

    public function __construct(EntityManager $em, TokenStorage $tokenStorage, Session $session)
    {
        $this->em           = $em;
        $this->tokenStorage = $tokenStorage;
        $this->session      = $session;
    }

    public function sendNotification(User $user, string $content)
    {
        $notification = new Notification();
        $notification->setUser($user)
                     ->setContent($content);

        $this->em->persist($notification);
        $this->em->flush();

        $this->session->getFlashBag()->add('success', "Notification envoyé");
    }

    /**
     * @return GameUserCharacter
     */
    public function getCurrentCharacter()
    {
        $user               = $this->tokenStorage->getToken()->getUser();
        $idCurrentCharacter = $user->getGameUser()->getCurrentCharacter();
        $currentCharacter   = $this->em->getRepository('App:GameCharacter')->findOneBy(['id' => $idCurrentCharacter]);

        $character = $this->em->getRepository('App:GameUserCharacter')
                    ->findCurrentCharacter($user, $currentCharacter)
        ;

        return $character;
    }
}