<?php
declare(strict_types=1);

namespace gift\appli\app\Action;

use gift\appli\core\domain\entites\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class AddToBoxAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, array $args): Response {

        $parsedBody = $request->getParsedBody();
        $prestationId = $args['id'];
        $quantity = isset($parsedBody['quantity']) ? (int)$parsedBody['quantity'] : 1;

        $prestation = Prestation::find($prestationId);

        if (!$prestation) {
            throw new HttpNotFoundException($request, "Aucune prestation trouvée avec l'ID $prestationId.");
        }

        if (!isset($_SESSION['box'])) {
            $_SESSION['box'] = [];
        }

        $prestationArray = [
            'id' => $prestation->id,
            'libelle' => $prestation->libelle,
            'cat_id' => $prestation->cat_id,
        ];

        if (isset($_SESSION['box'][$prestationId])) {
            $_SESSION['box'][$prestationId]['quantity'] += $quantity;
        } else {
            $_SESSION['box'][$prestationId] = [
                'prestation' => $prestationArray,
                'quantity' => $quantity,
            ];
        }

        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('BoxGet', [], ['id' => $prestationId]);
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
