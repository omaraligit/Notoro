<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/19/2018
 * Time: 10:53 AM
 */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Notoro\framework\renderer\Renderer;

class Controller {

    public static $DEFAULT_CONTROLLER_NAMESPACE = "App\Http\Controllers";
    /**
     * @var Renderer
     */
    public $view;
    public function __construct()
    {
        $this->view = new Renderer(views_folder());
    }
}