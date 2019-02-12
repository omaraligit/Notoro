<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 2/9/2019
 * Time: 12:17 AM.
 */

namespace Notoro\framework\services;

use Notoro\framework\App;

class ServiceProvider
{
    /**
     * @var App
     */
    public $app;

    /**
     * ServiceProvider constructor.
     *
     * @param App $app
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function register()
    {
    }

    /**
     * @param string $middlewaresLocation
     */
    public function pipeMiddlewares(string $middlewaresLocation)
    {
        $middlewares = require $middlewaresLocation;
        foreach ($middlewares as $middleware) {
            $this->app->pipe(new $middleware());
        }
    }

    /**
     * @param string $routesPath
     */
    public function linkRoutes(string $routesPath)
    {
        /** @var string $routesPath */
        require $routesPath;
    }
}
