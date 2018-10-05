<?php

require_once __DIR__.'/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;
use Symfony\Component\HttpKernel\HttpCache\Store;
use Symfony\Component\EventDispatcher\EventDispatcher;
use App\Kernel;
use App\EventListener\TestListener;


$request = Request::createFromGlobals();
$routes = require __DIR__.'/../config/routes.php';

$context = new RequestContext();
$matcher = new UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();

$dispatcher->addSubscriber(new TestListener());

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$kernel = new Kernel($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$kernel = new HttpCache(
    $kernel,
    new Store(__DIR__.'/../cache')
);

$kernel->handle($request)->send();
