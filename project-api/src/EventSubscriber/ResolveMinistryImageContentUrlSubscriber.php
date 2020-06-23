<?php


namespace App\EventSubscriber;


use ApiPlatform\Core\EventListener\EventPriorities;
use ApiPlatform\Core\Util\RequestAttributesExtractor;
use App\Entity\MinistryImage;
use App\Entity\ProjectAgreementFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Vich\UploaderBundle\Storage\StorageInterface;

class ResolveMinistryImageContentUrlSubscriber implements EventSubscriberInterface
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

        if (!($attributes = RequestAttributesExtractor::extractAttributes($request)) || !\is_a($attributes['resource_class'], ProjectAgreementFile::class, true)) {
            return;
        }

        $agreementFiles = $controllerResult;

        if (!is_iterable($agreementFiles)) {
            $agreementFiles = [$agreementFiles];
        }

        foreach ($agreementFiles as $agreementFile) {
            if (!$agreementFile instanceof ProjectAgreementFile) {
                continue;
            }

            $agreementFile->contentUrl = $this->storage->resolveUri($agreementFile, 'file');
        }
    }
}