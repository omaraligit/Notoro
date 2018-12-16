<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 12/15/2018
 * Time: 12:29 AM
 */

namespace NotoroTest;


use GuzzleHttp\Psr7\ServerRequest;
use Notoro\framework\App;
use PHPUnit\Framework\TestCase;

class AppTest extends TestCase
{

    public function testAsseertNewAppWorks(){
        $app = new App();
        $response = $app->run(new ServerRequest('GET','uri',[],''));
        $this->assertEquals(200,$response->getStatusCode());
    }

}