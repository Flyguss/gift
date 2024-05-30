<?php

namespace gift\appli\app\Action;



use gift\appli\core\domain\entites\Prestation;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use gift\appli\core\services\PrestationNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetPrestationByIdAction extends AbstractAction {

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->template = 'TwigPrestationById.twig' ;
        $this->catalogue = new CatalogueService();
    }

    /**
     * @throws SyntaxError
     * @throws PrestationNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $queryId = $rq->getQueryParams()['id'] ?? null;

        if ($queryId == null) {
            throw new HttpBadRequestException($rq, 'id prestation incorrect');
        }



            $p = $this->catalogue->getPrestationById($queryId);
            $view = Twig::fromRequest($rq);
            return $view->render($rs , $this->template , $p);


    }
}