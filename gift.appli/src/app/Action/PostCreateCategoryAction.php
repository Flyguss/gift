<?php

namespace gift\appli\app\Action;

use Exception;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\CatalogueService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class PostCreateCategoryAction {
    protected $catalogueService;

    public function __construct() {
        $this->catalogueService = new CatalogueService();
    }

    /**
     * @throws Exception
     */
    public function __invoke(Request $request, Response $response): Response {
        $parsedBody = $request->getParsedBody();

        if (!isset($parsedBody['csrf_token'])) {
            throw new Exception('CSRF token missing');
        }

        try {
            CsrfService::check($parsedBody['csrf_token']);
        } catch (Exception $e) {
            throw new Exception('CSRF validation failed: ' . $e->getMessage());
        }

        $this->catalogueService->createCategory($parsedBody);
        return $response->withStatus(302)->withHeader('Location', '/gift/gift.appli/public/categorie');
    }
}
