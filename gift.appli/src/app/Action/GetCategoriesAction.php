<?php

namespace gift\appli\app\Action;


use gift\appli\core\domain\entites\Categorie;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use gift\appli\core\services\CategoryNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class GetCategoriesAction extends AbstractAction {

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->template = 'TwigCategorie.twig' ;
        $this->catalogue = new CatalogueService();
    }

    /**
     * @throws SyntaxError
     * @throws CategoryNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $categories =  $this->catalogue->getCategories();
        $view = Twig::fromRequest($rq);
        $data = [
            'cate_list' => $categories
        ];
        return $view->render($rs , 'TwigCategorie.twig' , $data);

    }
}