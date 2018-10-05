<?php

require_once __DIR__.'/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use App\EventListener\StringResponseListener;
use Symfony\Component\DependencyInjection\Reference;


$sc = require __DIR__.'/../config/container.php';
$sc->setParameter('routes', include __DIR__.'/../config/routes.php');

$sc->register('listener.string_response', StringResponseListener::class);
$sc->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', [new Reference('listener.string_response')]);

$request = Request::createFromGlobals();

$response = $sc->get('kernel')->handle($request);
$response->send();
