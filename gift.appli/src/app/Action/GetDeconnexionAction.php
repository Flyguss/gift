<?php

namespace gift\appli\app\Action;



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetDeconnexionAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);
        unset($_SESSION['email']);
        unset($_SESSION['user_id']);
        return $view->render($rs , 'TwigDeconnexion.twig' );

    }
}