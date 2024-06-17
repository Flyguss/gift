<?php

namespace gift\api\src\action;

use gift\api\src\core\services\CategoryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class getCategoriesAction extends AbstractAction
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $categories = $this->categoryService->getAllCategories();
        $response->getBody()->write(json_encode($categories));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
