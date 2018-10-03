<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Response;


function isLeapYear($year = null)
{
    if (null === $year) {
        $year = date('Y');
    }

    return 0 === $year % 400 || (0 === $year % 4 && 0 !== $year % 100);
}

$routes = new RouteCollection();
$routes->add('hello', new Route('/hello/{name}', [
    'name' => 'World',
    '_controller' => 'render'
]));
$routes->add('bye', new Route('/bye', [
    '_controller' => 'render'
]));
$routes->add('leap_year', new Route('/is-leap-year/{year}', [
    'year' => null,
    '_controller' => function ($request) {
        if (isLeapYear($request->attributes->get('year'))) {
            return new Response('Yep, this is a leap year.');
        }

        return new Response('Nope, this is not a leap year.');
    }
]));

return $routes;