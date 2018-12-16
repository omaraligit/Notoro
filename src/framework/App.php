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
        $this->router->match($request);
        $response = new Response();
        $response->getBody()->write("app is runing");
        return $response;
    }

}