<?php

namespace gift\appli\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\core\domain\entites\Box;

class GetBoxAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        session_start();
        $box = $_SESSION['box'] ?? [];

        $existingBoxes = Box::all();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigBox.twig', ['box' => $box, 'existing_boxes' => $existingBoxes]);
    }
}
