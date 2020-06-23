<?php


namespace App\EventSubscriber;


class ResolveProjectAgreementContentUrlSubscriber
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

        if (!($attributes = RequestAttributesExtractor::extractAttributes($request)) || !\is_a($attributes['resource_class'], ProjectPaymentReceiptFiles::class, true)) {
            return;
        }

        $receiptFiles = $controllerResult;

        if (!is_iterable($receiptFiles)) {
            $receiptFiles = [$receiptFiles];
        }

        foreach ($receiptFiles as $receiptFile) {
            if (!$receiptFile instanceof ProjectPaymentReceiptFiles) {
                continue;
            }

            $receiptFiles->contentUrl = $this->storage->resolveUri($receiptFiles, 'file');
        }
    }
}