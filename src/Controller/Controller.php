<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;


class Controller
{
    private $templatePath = __DIR__.'/../../templates/';

    public function render(string $template, array $args)
    {
        $path = $this->templatePath.$template;

        if (!file_exists($path)) {
            throw new \Exception('Template not found.');
        }

        extract($args, EXTR_SKIP);
        ob_start();
        require sprintf($path);

        $response = new Response(ob_get_clean());
        $response->setTtl(10);
    
        return $response;
    }    
}