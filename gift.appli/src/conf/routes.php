<?php
declare(strict_types=1);

use gift\appli\app\Action\GetAcceuil;
use gift\appli\app\Action\GetBoxAction;
use gift\appli\app\Action\GetCategoriesAction;
use gift\appli\app\Action\GetCategoriesByIdAction;
use gift\appli\app\Action\GetPrestationByIdAction;
use gift\appli\app\Action\GetPrestationsAction;
use gift\appli\app\Action\PostBoxAction;

return function (\Slim\App $app) {

    $app->get('/', GetAcceuil::class)->setName('Acceuil');
    $app->get('/categorie', GetCategoriesAction::class)->setName('Categorie');
    $app->get('/categorie/{id:\d+}', GetCategoriesByIdAction::class)->setName('CategorieById');
    $app->get('/listeprestation', GetPrestationsAction::class)->setName('ListePrestation');
    $app->get('/prestation' , GetPrestationByIdAction::class)->setName('Prestation');
    $app->get('/box/create', GetBoxAction::class)->setName('BoxGet');
    $app->post('/box/create', PostBoxAction::class)->setName('BoxPost');



    return $app ;
};
