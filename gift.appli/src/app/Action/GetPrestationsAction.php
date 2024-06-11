<?php

namespace gift\appli\app\Action;



use gift\appli\core\domain\entites\Prestation;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use gift\appli\core\services\PrestationNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetPrestationsAction extends AbstractAction {

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->template = 'TwigPrestation.twig' ;
        $this->catalogue = new CatalogueService();
    }

    /**
     * @throws SyntaxError
     * @throws PrestationNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response {

        $params = $rq->getQueryParams();
        $sortOrder = $params['sort'] ?? null;
        $prestations = $this->catalogue->getPrestationsWithCategories($sortOrder);
        $view = Twig::fromRequest($rq);
        $data = [
            'presta_list' => $prestations,
            'sort' => $sortOrder
        ];
        return $view->render($rs, $this->template, $data);
    }
}