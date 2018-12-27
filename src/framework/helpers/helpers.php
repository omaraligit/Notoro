<?php 

const ROOT_PATH=__DIR__.'/../../..';

function views_folder(){
    return ROOT_PATH.'/resources/views';
}

function routes_folder(){
    return ROOT_PATH.'/routes';
}

function e($param){
    echo $param;
}