<?php
declare(strict_types=1);

use gift\appli\app\Action\GetAcceuil;
use gift\appli\app\Action\GetBoxAction;
use gift\appli\app\Action\GetCategoriesAction;
use gift\appli\app\Action\GetCategoriesByIdAction;
use gift\appli\app\Action\GetPrestationByIdAction;
use gift\appli\app\Action\GetPrestationsAction;
use gift\appli\app\Action\GetInscriptionAction;
use gift\appli\app\Action\PostBoxAction;
use gift\appli\app\Action\PostInscriptionAction;
use gift\appli\app\Action\AddToBoxAction;

return function (\Slim\App $app) {
    $app->get('/', GetAcceuil::class)->setName('Acceuil');
    $app->get('/categorie', GetCategoriesAction::class)->setName('Categorie');
    $app->get('/categorie/{id:\d+}', GetCategoriesByIdAction::class)->setName('CategorieById');
    $app->get('/listeprestation', GetPrestationsAction::class)->setName('ListePrestation');
    $app->get('/prestation', GetPrestationByIdAction::class)->setName('Prestation');
    $app->get('/box/create', GetBoxAction::class)->setName('BoxGet');
    $app->get('/inscription', GetInscriptionAction::class)->setName('Inscription');
    $app->post('/box/create', PostBoxAction::class)->setName('BoxPost');
    $app->post('/inscription', PostInscriptionAction::class)->setName('InscriptionPost');
    $app->post('/prestations/{id}/add', AddToBoxAction::class)->setName('add_to_box');

    return $app;
};
