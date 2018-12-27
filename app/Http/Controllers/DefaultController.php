<?php
/**
 * Created by PhpStorm.
 * User: Omar
 * Date: 12/19/2018
 * Time: 10:53 AM
 */

namespace App\Http\Controllers;


use GuzzleHttp\Psr7\Request;

class DefaultController extends Controller{

    public function index(){
        return ["omar"=>"ali"];
    }

    public function test(Request $request){
        return "

            <form method='post' enctype='multipart/form-data'>
            <input type='text' name='foo'><br>
            <input type='file' name='file'><br>
            <input type='submit' value='GO'> 
</form>

        ";
    }

    public function PostTest(Request $request){
        dd($request);
    }

    public function home($request,$params)
    {
        return $this->view->render('index',$params);
    }


}