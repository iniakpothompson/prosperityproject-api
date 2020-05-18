<?php
//
//
//namespace App\Listeners;
//
//
//use Symfony\Component\HttpKernel\Event\ResponseEvent;
//
//class CorsListener
//{
//    public function onKernelResponse(ResponseEvent $event)
//    {
//        $responseHeaders = $event->getResponse()->headers;
//        $responseHeaders->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
//        $responseHeaders->set('Access-Control-Allow-Origin', '*');
//        $responseHeaders->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
//    }
//}