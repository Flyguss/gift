<?php

namespace gift\appli\app\Action;



use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostBoxAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response{


        $parsedBody = $rq->getParsedBody();
        $name = htmlspecialchars($parsedBody['name'] ?? '');
        $description = htmlspecialchars($parsedBody['description'] ?? '');

        $data = ['name' => $name , 'description' => $description];

        $view = Twig::fromRequest($rq);
        return $view->render($rs , 'TwigPostBox.twig' , $data);
    }
}