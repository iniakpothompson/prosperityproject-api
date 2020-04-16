<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordResetSubsriber implements  EventSubscriberInterface
{
    private $entityManager;
    private $tokenManager;

   public  function __construct(EntityManagerInterface $entityManager, JWTTokenManagerInterface $tokenManager)
   {
        $this->entityManager=$entityManager;
        $this->tokenManager=$tokenManager;


   }

    public static function getSubscribedEvents()
    {
        return[
            KernelEvents::VIEW=>['generateToken', EventPriorities::POST_WRITE]
        ];
    }
    public function generateToken(ViewEvent $event){
        $entity=$event->getControllerResult();
        $method=$event->getRequest()->getMethod();

        if(!$entity instanceof User|| Request::METHOD_PUT!=$method){
            return;
        }
//        $context['groups'] = ['put-reset-password'];
        $this->entityManager->flush();

        //$data=new User();
       //$email=$data->getEmail();
        $token=$this->tokenManager->create(new User());
        return new JsonResponse(['token'=>$token]);

        //return $this->tokenManager->create();


    }
}