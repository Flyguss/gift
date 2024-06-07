<?php

namespace gift\appli\app\Action;



use AllowDynamicProperties;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostInscriptionAction extends AbstractAction {

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->templateValide = 'TwigPostInscription.twig' ;
        $this->templateInvalide = 'TwigInscription.twig' ;
        $this->catalogue = new CatalogueService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);

        $parsedBody = $rq->getParsedBody();
        $email = htmlspecialchars($parsedBody['name'] ?? '');
        $password = password_hash( htmlspecialchars($parsedBody['password'] ?? '') , PASSWORD_BCRYPT);
        if (! filter_var($email , FILTER_VALIDATE_EMAIL)){
            $data = [
                'erreur' => 'Email non conforme !'
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }


        $this->catalogue->addUser($email , $password , 1);



        return $view->render($rs , $this->templateValide );
    }
}