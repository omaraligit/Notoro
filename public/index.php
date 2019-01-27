<?php

require_once '../vendor/autoload.php';

use Notoro\framework\App;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use Notoro\framework\router\Router;
use Notoro\framework\renderer\Renderer;
/**
 * new app
 */
$container = new DI\Container();
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    'Router'=>new Router(),
    'Renderer' => new Renderer(views_folder())
]);
$container = $builder->build();

$app = new App($container);

// TODO :: add routing system
// TODO :: add templating system
// TODO :: add middleware system
// TODO :: add database connection

/**
 * sending the response to client
 */
$app->pipe(new \App\Http\middleware\AppMiddleware());
$app->pipe(new \Middlewares\Whoops());
$app->pipe(new \App\Http\middleware\ClientIp());
$response = $app->handle(ServerRequest::fromGlobals());
send($response);