<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class Controller
{
    public function render(Request $request)
    {
        extract($request->attributes->all(), EXTR_SKIP);
        ob_start();
        require sprintf(__DIR__.'/../src/pages/%s.php', $_route);
    
        return new Response(ob_get_clean());
    }    
}