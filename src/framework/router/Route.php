<?php

namespace Notoro\framework\router;

class Route {
    private $action;
    private $path;
    private $method;
    private $name;


    /**
     * Route constructor.
     * @param string $method
     * @param string $path
     * @param string|callable $action
     * @param string $name
     */
    public function __construct(string $method, string $path, string $action, string $name = "")
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;
        $this->name = $name;
    }


}