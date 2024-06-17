<?php

// Créer une nouvelle application Slim
use gift\api\src\Infrastructure\Eloquent;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();

// Ajouter les middlewares de routage et d'erreur
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, false, false);

(new Eloquent)->init(__DIR__ . '/gift.db.conf.ini');

// Inclure les routes
(require_once __DIR__ . '/routes.php')($app);

return $app ;
