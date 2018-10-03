<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class HomeController extends Controller
{

    public function index()
    {
        return $this->render('home/home.php', [
            'controller' => 'HomeController',
            'action' => 'index'
        ]);
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