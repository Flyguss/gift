<?php
declare(strict_types=1);

// Définir les routes
use gift\api\src\action\getBoxId;
use gift\api\src\action\getCategoriesAction;

use gift\api\src\action\GetPrestationsAction;
use gift\api\src\action\GetPrestationsByCategoryIdAction;
use Slim\App;

return function (App $app) {
    $app->get('/api/categories', getCategoriesAction::class);
    $app->get('/api/coffrets/{id}', getBoxId::class);
    $app->get('/api/categories/{id}/prestations', GetPrestationsByCategoryIdAction::class);
    $app->get('/api/prestations', GetPrestationsAction::class);
    $app->get('/test', function ($request, $response, $args) {
        $response->getBody()->write("Hello, this is a test!");
        return $response;
    });

    return $app;
};
