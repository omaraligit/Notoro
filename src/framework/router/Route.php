<?php

namespace Notoro\framework\router;

use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Route {
    private $action;
    private $path;
    private $method;
    private $name;
    private $_path;


    /**
     * Route constructor.
     * @param string $method
     * @param string $path
     * @param string|callable $action
     * @param string $name
     */
    public function __construct(string $method, string $path, $action, string $name = "")
    {
        $this->method = $method;
        $this->path = $path;
        $this->_path = $path;
        $this->action = $action;
        $this->name = $name;
    }

    public function isMatching(ServerRequestInterface $request)
    {
        $this->path = preg_replace("/\{([A-Za-z0-9\-_])+\}/","([A-Za-z0-9\-_])+",$this->path);
        $this->path = str_replace("/","\/",$this->path);

        if(strtoupper($request->getMethod()) == $this->method && preg_match("/^".$this->path."$/",$request->getUri()->getPath())){

            // TODO FIGUR OUT HOW TO FIND THE KEY AND GIVE IT THE VALUE


            preg_match("/\{([A-Za-z0-9\-_])+\}/", $this->_path, $chars,PREG_OFFSET_CAPTURE);

            // dd($chars,$request->getUri()->getPath(),$this->path);
            $response  = new Response(200);

            if ($this->action instanceof \Closure){

                $functionResponse = call_user_func($this->action,$request);


            }else{
                $defaultNamespace = Controller::$DEFAULT_CONTROLLER_NAMESPACE;
                /**
                 * separaating the class from the methode
                 */
                $action = explode("@",$this->action);
                $actionClass =$defaultNamespace."\\".$action[0];
                /**
                 * instantiating the controller class
                 */
                $controllerInstance = new $actionClass();
                $methode            = $action[1];

                $functionResponse = $controllerInstance->$methode($request);
            }

            if ($this->isJSON($functionResponse)){

                $response->withHeader('Content-Type','application/json');
                $response->getBody()->write($functionResponse);

            } else if(is_string($functionResponse)){

                $response->getBody()->write($functionResponse);

            } else if(is_array($functionResponse)){

                $response->withHeader('Content-Type','application/json');
                $response->getBody()->write(json_encode($functionResponse));

            } else if (is_object($functionResponse)){

                $response->withHeader('Content-Type','application/json');
                $response->getBody()->write(json_encode($functionResponse));

            } else{

                $response->getBody()->write($this->action);

            }

            return $response;
        }

    }


    public function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }


}