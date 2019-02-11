<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 2/9/2019
 * Time: 12:17 AM
 */

namespace Notoro\framework\services;


use Notoro\framework\App;
use Psr\Http\Server\MiddlewareInterface;

class ServiceProvider
{
    /**
     * ServiceProvider constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function register(){}

    /**
     * @param MiddlewareInterface[] $middlewares
     */
    public function pipeMiddlewares(string $middlewaresLocation){
        $middlewares = require_once $middlewaresLocation;
        foreach ($middlewares as $middleware){
            $this->app->pipe(new $middleware());
        }
    }

    public function linkRoutes($routesPath){
        require_once $routesPath;
    }
}