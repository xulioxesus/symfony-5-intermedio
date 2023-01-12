<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Doctrine\ORM\EntityManagerInterface;

class RegistrarInicioSesionUsuarioSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em ){
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $usuario = $event->getAuthenticationToken()->getUser();

        $usuario->setUltimoAcceso(new \Datetime());
        $this->em->persist($usuario);
        $this->em->flush();
    }

    public static function getSubscribedEvents()
    {
        return [
            'security.interactive_login' => 'onSecurityInteractiveLogin',
        ];
    }
}
