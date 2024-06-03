<?php

namespace gift\appli\app\Action;



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostInscriptionAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{


        $parsedBody = $rq->getParsedBody();
        $email = htmlspecialchars($parsedBody['name'] ?? '');
        $password = password_hash( htmlspecialchars($parsedBody['password'] ?? '') , PASSWORD_BCRYPT);

        $data = ['name' => $email , 'description' => $password];

        $view = Twig::fromRequest($rq);
        return $view->render($rs , 'TwigPostBox.twig' , $data);
    }
}