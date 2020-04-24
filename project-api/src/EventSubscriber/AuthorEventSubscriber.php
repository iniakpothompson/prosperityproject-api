<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\AuthorEntityInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthorEventSubscriber implements  EventSubscriberInterface
{
private $token;
public function __construct(TokenStorageInterface $token)
{
    $this->token=$token;
}

    public static function getSubscribedEvents()
    {
       return [
           KernelEvents::VIEW=>['getAuthor', EventPriorities::PRE_WRITE]
       ];
    }
    public function getAuthor(ViewEvent $evt){
        $entity=$evt->getControllerResult();

        $method=$evt->getRequest()->getMethod();
        /**
         * @var UserInterface $storedUser
         */
        $storedUser=$this->token->getToken()->getUser();
//        $refreshToken=$this->token->


        if(!$entity instanceof AuthorEntityInterface || Request::METHOD_POST!=$method){
            return;
        }
            $entity->setUser($storedUser);
    }
}