<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\UserConfirmation;
use App\Repository\UserRepository;
use App\Security\UserConfirmationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class UserConfirmationSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserConfirmationService
     */
    private $userConfirmationService;
    private $userRepo;
    private $entity;

    public function __construct(
        UserConfirmationService $userConfirmationService,
        UserRepository $userRepository, EntityManagerInterface $entityManager
    ) {
        $this->userConfirmationService = $userConfirmationService;
        $this->userRepo=$userRepository;
        $this->entity=$entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                'confirmUser',
                EventPriorities::POST_VALIDATE,
            ],
        ];
    }

    public function confirmUser(ViewEvent $event)
    {
        $request = $event->getRequest();

        if ('api_user_confirmations_post_collection' !==
            $request->get('_route')) {
            return;
        }

        /** @var UserConfirmation $confirmationToken */
        $confirmationToken = $event->getControllerResult();

        $user=$this->userRepo->findOneBy(
            ['confirmationToken'=>$confirmationToken->confirmationToken]
        );
        /**
         * User was not found with the provided confirmation token
         */
        if(!$user){
            throw new NotFoundHttpException();
        }

        $user->setConfirmationToken(null);
        $user->setIsActive(true);
        $this->entity->flush();
//        $this->userConfirmationService->confirmUser(
//            $confirmationToken->confirmationToken
//        );

        $event->setResponse(new JsonResponse(null, Response::HTTP_OK));
    }
}