<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use App\Entity\MinistryImage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Vich\UploaderBundle\Storage\StorageInterface;

class ResolveMinistryImageContentUrlSubscriber
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

        if (!($attributes = RequestAttributesExtractor::extractAttributes($request)) || !\is_a($attributes['resource_class'], MinistryImage::class, true)) {
            return;
        }

        $minimages = $controllerResult;

        if (!is_iterable($minimages)) {
            $minimages = [$minimages];
        }

        foreach ($minimages as $minimage) {
            if (!$minimage instanceof MinistryImage) {
                continue;
            }

            $minimage->contentUrl = $this->storage->resolveUri($minimage, 'file');
        }
    }
}