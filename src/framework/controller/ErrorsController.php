<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 1/26/2019
 * Time: 8:32 PM
 */

namespace Notoro\framework\controller;

use App\Http\Controllers\Controller;

class ErrorsController extends Controller
{
    public function pageNotFound()
    {
        return $this->view->render('404');
    }
}
