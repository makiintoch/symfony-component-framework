<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends Controller
{

    public function index()
    {
        return new Response('This is home page');
    }

    public function hello($name)
    {
        return new Response("Hello {$name}!!!");
    }

    public function bye($name)
    {
        return new Response("Bye {$name} :(");
    }
}