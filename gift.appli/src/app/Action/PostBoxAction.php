<?php

namespace gift\appli\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostBoxAction extends AbstractAction {

    public function __invoke(Request $rq, Response $rs, array $args): Response {
        session_start();

        $parsedBody = $rq->getParsedBody();
        $name = htmlspecialchars($parsedBody['name'] ?? '');
        $description = htmlspecialchars($parsedBody['description'] ?? '');
        $kdo = isset($parsedBody['kdo']) ? 'Oui' : 'Non';
        $message = htmlspecialchars($parsedBody['message'] ?? '');
        $box = $_SESSION['box'] ?? [];

        $data = [
            'name' => $name,
            'description' => $description,
            'kdo' => $kdo,
            'message' => $message,
            'box' => $box
        ];

        // Clear the session box after creating the box
        unset($_SESSION['box']);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigPostBox.twig', $data);
    }
}
