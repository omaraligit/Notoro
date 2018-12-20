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
use Notoro\framework\router\Router;
use Psr\Http\Message\ServerRequestInterface;

class App
{
    /**
     * @var Router
     */
    private $router;

    public function __construct(Container $container)
    {
        $sep = DIRECTORY_SEPARATOR;
        require_once __DIR__.$sep."..".$sep."..".$sep."routes".$sep."web.php";
        $this->router = $container->get('Router');
    }

    public function run(ServerRequestInterface $request)
    {
        if(\strlen($request->getUri()->getPath()) > 1 && substr($request->getUri()->getPath(),-1) == "/"){
            return (new Response())
                ->withStatus(301)
                ->withHeader('Location',substr($request->getUri()->getPath(),0,-1));
        }
        return $this->router->match($request);
    }

}