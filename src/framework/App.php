<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 12/14/2018
 * Time: 11:56 PM.
 */

namespace Notoro\framework;

use DI\Container;
use Notoro\framework\router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{
    private $request;
    public $container;
    /**
     * @var MiddlewareInterface[]
     */
    public $middleware = [];
    public $serviceProviders;

    public function __construct(Container $container)
    {
        $this->container = $container;
        $this->serviceProviders = require config_folder() . '/app.php';
        $this->registerProviders();
    }

    public function run(ServerRequestInterface $request)
    {
        $this->request = $request;

        return (new Router())->match($request);
    }

    /**
     * @param MiddlewareInterface $middleware
     */
    public function pipe(MiddlewareInterface $middleware)
    {
        $this->middleware[] = $middleware;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     *
     * @param ServerRequestInterface $request
     *
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $middleware = array_shift($this->middleware);
        if (null === $middleware) {
            return $this->run($request);
        }

        return $middleware->process($request, $this);
    }

    private function registerProviders()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            (new $serviceProvider($this))->register();
        }
    }
}
