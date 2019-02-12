<?php
/**
 * Created by PhpStorm.
 * User: omar
 * Date: 12/15/2018
 * Time: 12:29 AM.
 */

namespace NotoroTest;

use GuzzleHttp\Psr7\ServerRequest;
use Notoro\framework\App;
use Notoro\framework\renderer\Renderer;
use Notoro\framework\router\Router;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class AppTest extends TestCase
{
    /**
     * @var App
     */
    public $app;
    public $container;

    protected function setUp()
    {
        $this->container = new \DI\Container();
        $builder = new \DI\ContainerBuilder();
        $builder->addDefinitions([
            'Router'   => new Router(),
            'Renderer' => new Renderer(views_folder())
        ]);
        $this->container = $builder->build();
    }

    public function testNewApp()
    {
        $app = new App($this->container);
        /** @var ResponseInterface $response */
        $response = $app->handle(new ServerRequest('GET', '/home'));
        /* assert response is of type ResponseInterface */
        $this->assertInstanceOf(ResponseInterface::class, $response);
        /* assert response status in 200 */
        $this->assertSame(200, $response->getStatusCode());
    }
}
