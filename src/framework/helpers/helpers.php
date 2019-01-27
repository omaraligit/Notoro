<?php 

const ROOT_PATH=__DIR__.'/../../..';

// TODO make into a class

$dotenv = Dotenv\Dotenv::create(ROOT_PATH);
$dotenv->load();

function base_folder(){
    return ROOT_PATH;
}

function views_folder(){
    return base_folder().'/resources/views';
}

function routes_folder(){
    return base_folder().'/routes';
}

function e($param){
    echo $param;
}

function getContainer(){
    global $container;
    return $container;
}