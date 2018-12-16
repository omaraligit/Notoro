<?php

namespace Notoro\framework\router;

use Psr\Http\Message\ServerRequestInterface;

class Router {
    public $i=10;
    public static $routes = [];


    /**
     * @param string $path
     * @param string|callable $action
     */
    static public function get(string $path, string $action){
        self::$routes[] = new Route('GET', $path, $action);
    }

    /**
     * @param ServerRequestInterface $request
     */
    public function match(ServerRequestInterface $request){

    }

}