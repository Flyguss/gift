<?php

use PHPUnit\Framework\TestCase;
use gift\appli\app\Action\PostConnexionAction;
use gift\appli\core\services\AuthentificationServiceInterface;
use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class PostConnexionActionTest extends TestCase
{
    public function testTokenCreatedOnInvalidLogin()
    {
        $authMock = $this->createMock(AuthentificationServiceInterface::class);
        $authMock->method('getUserByEmail')->willReturn(null);

        $rqMock = $this->createMock(ServerRequestInterface::class);
        $rqMock->method('getParsedBody')->willReturn([
            'name' => 'test@lambda.com',
            'password' => '123456789',
            'csrf_token' => 'un_token'
        ]);

        $rsMock = $this->createMock(ResponseInterface::class);
        $twigMock = $this->createMock(Twig::class);
        $twigMock->method('render')->willReturn($rsMock);

        CsrfService::generate();

        $action = new PostConnexionAction();
        $response = $action($rqMock, $rsMock, []);
        $this->assertNotNull($response);
    }
}
