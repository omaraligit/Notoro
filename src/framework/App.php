<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 12/14/2018
 * Time: 11:56 PM
 */

namespace Notoro\framework;


use DI\Container;
use GuzzleHttp\Psr7\Response;
use Notoro\framework\middleware\RequestHandler;
use Notoro\framework\router\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class App implements RequestHandlerInterface
{
    /**
     * @var Router
     */
    private $router;
    private $request;
    private $container;
    /**
     * @var MiddlewareInterface[]
     */
    private $middleware = [];

    public function __construct(Container $container)
    {
        $sep = DIRECTORY_SEPARATOR;
        require_once __DIR__.$sep."..".$sep."..".$sep."routes".$sep."web.php";
        $this->router = $container->get('Router');
        $this->container = $container;
    }

    public function run(ServerRequestInterface $request)
    {
        if(\strlen($request->getUri()->getPath()) > 1 && substr($request->getUri()->getPath(),-1) == "/"){
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location',substr($request->getUri()->getPath(),0,-1));
        }
        $this->request = $request;
        return $this->router->match($request);
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
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        //$this->run($request);
        $middleware = array_shift($this->middleware);
        if (null === $middleware) {
            return $this->run($request);
        }
        return $middleware->process($request,$this);

    }
}