<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/19/2018
 * Time: 10:53 AM.
 */

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\ServerRequest;

class DefaultController extends Controller
{
    public function index(ServerRequest $request)
    {
        return $this->view->render('index', ['name'=>'omar', 'id'=>15]);
    }
}
