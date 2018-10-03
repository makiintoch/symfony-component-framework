<?php

require_once __DIR__.'/vendor/autoload.php';


use Symfony\Component\HttpFoundation\Response;


$response = new Response('Goodbye');
$response->send();