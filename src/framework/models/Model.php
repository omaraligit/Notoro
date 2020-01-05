<?php

namespace Notoro\framework\models;

use ReflectionClass;

class Model implements ModelInterface
{
    public $table;

    public function __construct()
    {
        $reflectioClass = new ReflectionClass($this);
        $this->table = mb_strtolower($reflectioClass->getShortName());
    }
}
