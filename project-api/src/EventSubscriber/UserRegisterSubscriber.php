<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Email\Mailer;
use App\Entity\User;
use App\Security\TokenGenerator;
use App\Security\UserConfirmationService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpKernel\Event\ViewEvent;
class UserRegisterSubscriber implements EventSubscriberInterface
{
    private $encoder;
    private $tokenGenerator;
    private $swiftMailer;
public function __construct(UserPasswordEncoderInterface $encoder, TokenGenerator $tokenGenerator, Mailer $mailer)
{
    $this->encoder=$encoder;
    $this->tokenGenerator=$tokenGenerator;
    $this->swiftMailer=$mailer;
}

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents()
    {
       return [
         KernelEvents::VIEW=>['userRegistered', EventPriorities::PRE_WRITE]
       ];
    }
    public function userRegistered(ViewEvent $evt){

            $user=$evt->getControllerResult();
            $method=$evt->getRequest()->getMethod();
            if(!$user instanceof User || !in_array($method,[Request::METHOD_POST])){
                return;
            }
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            //Create Confirmation token;
        $user->setConfirmationToken($this->tokenGenerator->getRandomSecureToken());

        // End email for password reset
//        $message=(new \Swift_Message('Password Reset'))
//            ->setFrom('ayibatonbrapa@gmail.com')
//            ->setTo("ayibatonbrapa@gmail.com")
//            ->setBody('Hi, This is a test Email for password reset');

        $this->swiftMailer->sendMail($user);
    }
}