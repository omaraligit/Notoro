<?php

use GuzzleHttp\Psr7\Response;
use Notoro\framework\router\Router;
use Psr\Http\Message\ServerRequestInterface;

class Omar{
    public $id = 1995;
}

Router::get('/','DefaultController@index');
Router::get('/home',function (ServerRequestInterface $request){
    return "<h1>home</h1>";
});
Router::get('/test','DefaultController@test');
Router::post('/test','DefaultController@PostTest');
Router::get('/home/{id}/test','DefaultController@home');
