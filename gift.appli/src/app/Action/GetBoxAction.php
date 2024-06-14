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

        $box = $_SESSION['box'] ?? [];

        $create = '2024-05-14 13:28:00';

        $existingBoxes = Box::with('prestations')->where('created_at', $create)->get();

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigBox.twig', ['box' => $box, 'existing_boxes' => $existingBoxes]);
    }
}
