<?php


namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use App\Entity\ProjectImages;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Vich\UploaderBundle\Storage\StorageInterface;

class ResolveProjectImageContentUrlSubscriber implements  EventSubscriberInterface
{
private $storage;

    function __construct(StorageInterface $store)
    {
        $this->storage=$store;
    }

    /**
     * @inheritDoc
     */
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW=>['onPreSerialize', EventPriorities::PRE_SERIALIZE],
        ];
    }
    public function onPreSerialize(ViewEvent $event): void
    {
        $controllerResult = $event->getControllerResult();
        $request = $event->getRequest();

        if ($controllerResult instanceof Response || !$request->attributes->getBoolean('_api_respond', true)) {
            return;
        }

        if (!($attributes = RequestAttributesExtractor::extractAttributes($request)) || !\is_a($attributes['resource_class'], ProjectImages::class, true)) {
            return;
        }

        $projectimages = $controllerResult;

        if (!is_iterable($projectimages)) {
            $projectimages = [$projectimages];
        }

        foreach ($projectimages as $projectimage) {
            if (!$projectimage instanceof ProjectImages) {
                continue;
            }

            $projectimage->contentUrl = $this->storage->resolveUri($projectimage, 'file');
        }
    }
}