<?php

namespace gift\api\src\action;

use gift\api\src\core\services\PrestationService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationsAction
{
    protected $prestationService;

    public function __construct()
    {
        $this->prestationService = new PrestationService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $prestations = $this->prestationService->getAllPrestations();
        $response->getBody()->write(json_encode($prestations));
        return $response->withHeader('Content-Type', 'application/json');
    }

}