<?php

require_once '../vendor/autoload.php';

use Notoro\framework\App;
use function Http\Response\send;
use GuzzleHttp\Psr7\ServerRequest;
use Notoro\framework\router\Router;
/**
 * new app
 */
$container = new DI\Container();
$builder = new DI\ContainerBuilder();
$builder->addDefinitions([
    'Router'=>new Router()
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
$response = $app->run(ServerRequest::fromGlobals());
send($response);