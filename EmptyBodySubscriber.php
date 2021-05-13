<?php


namespace App\EventSubscriber;
use ApiPlatform\Core\EventListener\EventPriorities;
use App\Exception\EmptyBodyException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class EmptyBodySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [

            KernelEvents::REQUEST => [
                'handleEmptyBody',
                EventPriorities::PRE_DESERIALIZE,
            ],
        ];
    }

    public function handleEmptyBody(RequestEvent $event)
    {
        $request = $event->getRequest();
        $method = $request->getMethod();
        $route = $request->get('_route');

        if (!in_array($method, [Request::METHOD_POST, Request::METHOD_PUT]) ||
            in_array($request->getContentType(), ['html', 'form','json','form-data', 'jsonld']) ||
            substr($route, 0, 3) !== 'api') {
            return;
        }

        $data = $event->getRequest()
            ->get('data');
       // var_dump($data);die("no Data");

        if ( $data === null ) {
            throw new EmptyBodyException();
        }
    }
}