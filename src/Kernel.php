<?php


namespace App;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpKernel\HttpKernelInterface;


class Kernel implements HttpKernelInterface
{
    protected $dispatcher;
    protected $matcher;
    protected $controllerResolver;
    protected $argumentResolver;

    public function __construct(EventDispatcher $dispatcher, UrlMatcherInterface $matcher, ControllerResolverInterface $controllerResolver, ArgumentResolverInterface $argumentResolver)
    {
        $this->dispatcher = $dispatcher;
        $this->matcher = $matcher;
        $this->controllerResolver = $controllerResolver;
        $this->argumentResolver = $argumentResolver;
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        $this->matcher->getContext()->fromRequest($request);
        
        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));
        
            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);
        
            $response = call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Page Not Found', 404);
        } catch (\Exception $e) {
            $response = new Response('Caught exception: '.$e->getMessage(), 500);
        }

        $this->dispatcher->dispatch('response', new ResponseEvent($response, $request));

        return $response;
    }
}