<?php

const ROOT_PATH=__DIR__.'/../../..';

// TODO make a class to manage .env files


function base_folder()
{
    return ROOT_PATH;
}

function views_folder()
{
    return base_folder().'/resources/views';
}

function routes_folder()
{
    return base_folder().'/routes';
}

function config_folder()
{
    return base_folder().'/config';
}

function e($param)
{
    echo $param;
}

function getContainer()
{
    global $container;
    return $container;
}
