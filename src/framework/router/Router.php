<?php

namespace Notoro\framework\router;

use GuzzleHttp\Psr7\Response;
use Notoro\framework\controller\ErrorsController;
use Psr\Http\Message\ServerRequestInterface;

class Router {
    public $i=10;
    public static $routes = [];


    /**
     * @param string $path
     * @param string|callable $action
     */
    static public function get(string $path, $action){
        self::$routes[] = new Route('GET', $path, $action);
    }

    /**
     * @param string $path
     * @param string|callable $action
     */
    public static function post(string $path, $action)
    {
        self::$routes[] = new Route('POST', $path, $action);
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function match(ServerRequestInterface $request){

        /** @var Route $route */
        foreach (self::$routes as $route){
            $response = $route->isMatching($request);
            if(!is_null($response)){
                return $response;
            }
        }
        if(is_null($response)){
            $response = new Response(404);
            $notFoundController = ErrorsController::class;
            /**
             * separating the class from the method
             */
            $action = 'PageNotFound';
            $actionClass =$notFoundController;
            /**
             * instantiating the controller class
             */
            $controllerInstance = new $actionClass();
            $method             = $action;

            $notFoundPage = $controllerInstance->$method($request);
            $response->getBody()->write($notFoundPage);
            return $response;
        }


    }

}