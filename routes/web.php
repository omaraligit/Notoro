<?php

use Notoro\framework\router\Router;
use Psr\Http\Message\ServerRequestInterface;

Router::get('/', 'DefaultController@index');
Router::get('/home', function (ServerRequestInterface $request) {
    return '<h1>home</h1>';
});
Router::get('/test', 'DefaultController@test');
Router::post('/test', 'DefaultController@PostTest');
Router::get('/home/{id}/test', 'DefaultController@home');
Router::get('/home/{id}/t/{name}', 'DefaultController@home');
Router::get('/home/{id}/t/{name}/{last}', 'DefaultController@home');
