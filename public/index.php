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

// TODO :: change app to service provider
// TODO :: implement routing name helper
// TODO :: work on the rendring system
// TODO :: add test to test the framework
// TODO :: make Config interface for config access / register app's moduls config locations

/** piping middlewares */
$app->pipe(new \App\Http\middlewares\ClientIpMiddleware());
/**  sending the response to client */
$response = $app->handle(ServerRequest::fromGlobals());
send($response);