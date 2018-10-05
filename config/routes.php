<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Controller\HomeController;


$routes = new RouteCollection();
$routes->add('home', new Route('/', [
    '_controller' => [HomeController::class, 'index']
]));
$routes->add('home_hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => [HomeController::class, 'hello']
]));
$routes->add('home_bye', new Route('/bye/{name}', [
    'name' => 'World',
    '_controller' => [HomeController::class, 'bye']
]));
$routes->add('home_test', new Route('/test', [
    '_controller' => [HomeController::class, 'test']
]));

return $routes;