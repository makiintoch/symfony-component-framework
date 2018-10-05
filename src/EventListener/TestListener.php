<?php


namespace App\EventListener;


use App\ResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class TestListener implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return ['response' => 'onResponse'];
    }

    public function onResponse(ResponseEvent $event)
    {
        $response = $event->getResponse();

        if ($response->isRedirection()
            || ($response->headers->has('Content-Type') && false === strpos($response->headers->get('Content-Type'), 'html'))
            || 'html' !== $event->getRequest()->getRequestFormat()
        ) return;

    $response->setContent($response->getContent().'ADD TEST EVENT');
    }
}