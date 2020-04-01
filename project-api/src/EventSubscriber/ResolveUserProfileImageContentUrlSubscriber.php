<?php


namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use App\Entity\CommentImages;
use App\Entity\UserProfileImages;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Vich\UploaderBundle\Storage\StorageInterface;
class ResolveUserProfileImageContentUrlSubscriber implements EventSubscriberInterface
{
    private $storage;
    function __construct(StorageInterface $storage)
    {
        $this->storage=$storage;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW=>['onPreserialize', EventPriorities::PRE_SERIALIZE],
        ];
    }

    function onPreserialize(ViewEvent $event):void{
        $controllerResult = $event->getControllerResult();
        $request = $event->getRequest();

        if ($controllerResult instanceof Response || !$request->attributes->getBoolean('_api_respond', true)) {
            return;
        }

        if (!($attributes = RequestAttributesExtractor::extractAttributes($request)) || !\is_a($attributes['resource_class'], UserProfileImages::class, true)) {
            return;
        }

        $userprofileimages = $controllerResult;

        if (!is_iterable($userprofileimages)) {
            $userprofileimages = [$userprofileimages];
        }

        foreach ($userprofileimages as $userprofileimage) {
            if (!$userprofileimage instanceof UserProfileImages) {
                continue;
            }

            $userprofileimage->contentUrl = $this->storage->resolveUri($userprofileimage, 'file');
        }
    }
}