<?php

require_once __DIR__.'/../vendor/autoload.php';


use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;


$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = require __DIR__.'/../config/routes.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new App\EventListener\TestListener());
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));
$dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
$dispatcher->addSubscriber(new HttpKernel\EventListener\ExceptionListener('App\Controller\ErrorController::exception'));


$kernel = new App\Kernel($dispatcher, $controllerResolver, $requestStack, $argumentResolver);

$response = $kernel->handle($request);
$response->send();
