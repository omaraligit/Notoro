<?php

use Notoro\framework\router\Router;

Router::get('/','DefaultController@index');
Router::get('/test','DefaultController@test');
Router::get('/home/{id}','DefaultController@home');
