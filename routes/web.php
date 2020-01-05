<?php

use Notoro\framework\router\Router;
use Psr\Http\Message\ServerRequestInterface;

Router::get('/', 'DefaultController@index');
