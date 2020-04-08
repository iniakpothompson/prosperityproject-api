<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpKernel\Event\ViewEvent;
class PasswordHashEventSubscriber implements EventSubscriberInterface
{
    private $encoder;
public function __construct(UserPasswordEncoderInterface $encoder)
{
    $this->encoder=$encoder;
}

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
       return [
         KernelEvents::VIEW=>['hashPassword', EventPriorities::PRE_WRITE]
       ];
    }
    public function hashPassword(ViewEvent $evt){

            $user=$evt->getControllerResult();
            $method=$evt->getRequest()->getMethod();
            if(!$user instanceof User || Request::METHOD_POST!=$method){
                return;
            }
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
    }
}