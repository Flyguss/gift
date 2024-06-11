<?php

namespace gift\appli\app\Action;

use Slim\Views\Twig;
use gift\appli\app\utils\CsrfService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class GetCreateCategoryAction {
    protected $view;

    public function __construct() {
    }

    public function __invoke(Request $request, Response $response): Response {
        $csrf_token = CsrfService::generate();
        $view = Twig::fromRequest($request);

        return $view->render($response, 'TwigCreateCategory.twig', ['csrf_token' => $csrf_token]);
    }
}