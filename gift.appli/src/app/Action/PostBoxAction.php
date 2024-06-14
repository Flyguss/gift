<?php

namespace gift\appli\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\core\domain\entites\Box;
use gift\appli\core\domain\entites\Prestation;

class PostBoxAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $parsedBody = $rq->getParsedBody();
        $name = htmlspecialchars($parsedBody['name'] ?? '');
        $description = htmlspecialchars($parsedBody['description'] ?? '');
        $kdo = isset($parsedBody['kdo']) ? 'Oui' : 'Non';
        $message = htmlspecialchars($parsedBody['message'] ?? '');
        $existingBoxId = $parsedBody['existing_box'] ?? null;
        $quantities = $parsedBody['quantities'] ?? [];

        foreach ($quantities as $key => $quantity) {
            if (isset($_SESSION['box'][$key])) {
                $_SESSION['box'][$key]['quantity'] = (int)$quantity;
            }
        }

        $userId = $_SESSION['user_id'] ?? null;

        $newBox = new Box();
        $newBox->libelle = $name;
        $newBox->description = $description;
        $newBox->kdo = $kdo;
        $newBox->message_kdo = $message;
        $newBox->createur_id = $userId;
        $newBox->save();

        if ($existingBoxId) {
            $existingBox = Box::find($existingBoxId);
            if ($existingBox) {
                foreach ($existingBox->prestations as $prestation) {
                    $newBox->prestations()->attach($prestation->id, ['quantite' => $prestation->pivot->quantite]);
                }
            }
        }

        $sessionBox = $_SESSION['box'] ?? [];
        foreach ($sessionBox as $item) {
            $newBox->prestations()->attach($item['prestation'], ['quantite' => $item['quantity']]);
        }

        $data = [
            'name' => $name,
            'description' => $description,
            'kdo' => $kdo,
            'message' => $message,
            'prestations' => $newBox->prestations()->withPivot('quantite')->get()
        ];

        unset($_SESSION['box']);

        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigPostBox.twig', $data);
    }
}
