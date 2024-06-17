<?php

namespace gift\api\src\action;

use gift\api\src\core\services\CategoryService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetPrestationsByCategoryIdAction extends AbstractAction
{
    protected $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $categoryId = (int) $args['id'];
        $prestations = $this->categoryService->getPrestationsByCategoryId($categoryId);
        if ($prestations) {
            $response->getBody()->write(json_encode($prestations));
            return $response->withHeader('Content-Type', 'application/json');
        }

        return $response->withStatus(404, 'Category or Prestations not found');
    }
}
