<?php
declare(strict_types=1);

namespace gift\appli\app\Action;

use gift\appli\app\Action\AbstractAction;
use gift\appli\core\domain\entites\Prestation;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Routing\RouteContext;

class AddToBoxAction extends AbstractAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $prestationId = $args['id'];
        $parsedBody = $request->getParsedBody();
        $quantity = isset($parsedBody['quantity']) ? (int)$parsedBody['quantity'] : 1;

        // Fetch the prestation from the database
        $prestation = Prestation::find($prestationId);

        if (!$prestation) {
            throw new HttpNotFoundException($request, "Aucune prestation trouvée avec l'ID $prestationId.");
        }

        // Get the session to store the box contents
        session_start();
        if (!isset($_SESSION['box'])) {
            $_SESSION['box'] = [];
        }

        $box = &$_SESSION['box'];

        if (isset($box[$prestationId])) {
            $box[$prestationId]['quantity'] += $quantity;
        } else {
            $box[$prestationId] = [
                'prestation' => $prestation,
                'quantity' => $quantity,
            ];
        }

        // Redirect to the same prestation page
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();
        $url = $routeParser->urlFor('Prestation', [], ['id' => $prestationId]);
        return $response->withHeader('Location', $url)->withStatus(302);
    }
}
