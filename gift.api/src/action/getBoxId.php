<?php

namespace gift\api\src\action;


use gift\api\src\core\services\BoxService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getBoxId extends AbstractAction
{
    protected $boxService;

    public function __construct()
    {
        $this->boxService = new BoxService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $boxId = $args['id'];
        $box = $this->boxService->getBoxById($boxId);
        if ($box) {
            $response->getBody()->write(json_encode($box));
            return $response->withHeader('Content-Type', 'application/json');
        }

        return $response->withStatus(404, 'Box not found');
    }

}