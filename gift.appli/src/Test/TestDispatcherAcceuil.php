<?php

namespace gift\appli\Test;

use PHPUnit\Framework\TestCase;
use Slim\Psr7\Factory\ServerRequestFactory;
use Psr\Http\Message\ResponseInterface;

class TestDispatcherAcceuil extends TestCase {

    public function testDispatcherAcceuil (): void
    {
        $app = require_once __DIR__ . '/../conf/bootstrap.php';
        $request = (new ServerRequestFactory())->createServerRequest('GET', '/');
        $response = $app->handle($request);
        $this->assertInstanceOf(ResponseInterface::class, $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

}