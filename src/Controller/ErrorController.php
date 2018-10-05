<?php


namespace App\Controller;


use Symfony\Component\Debug\Exception\FlattenException;


class ErrorController extends Controller
{

    public function exception(FlattenException $exception)
    {
        $error = "Something went wrong! ({$exception->getMessage()})";

        return $this->render('error/error.php', [
            'error' => $error
        ]);
    }
}