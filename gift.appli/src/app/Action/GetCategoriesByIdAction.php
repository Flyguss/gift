<?php

namespace gift\appli\app\Action;


use gift\appli\core\domain\entites\Categorie;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use gift\appli\core\services\CategoryNotFoundException;
use gift\appli\core\services\PrestationNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetCategoriesByIdAction extends AbstractAction {

    /**
     * @throws SyntaxError
     * @throws CategoryNotFoundException
     * @throws PrestationNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->template = 'TwigCategorieById.twig' ;
        $this->catalogue = new CatalogueService();
    }
    public function __invoke(Request $rq, Response $rs, array $args ): Response{
            $categories =  $this->catalogue->getCategorieById($args['id']);
            $view = Twig::fromRequest($rq);
            $prestation = $this->catalogue->getPrestationsbyCategorie($args['id']) ;
            $data = [
              'id' =>$categories['id'],
              'libelle' =>$categories['libelle'],
              'description' =>$categories['description'],
              'prestation' => $prestation
            ];

            return $view->render($rs , $this->template , $data);




    }
}