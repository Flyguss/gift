<?php

namespace gift\appli\app\Action;



use AllowDynamicProperties;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\AuthentificationService;
use gift\appli\core\services\AuthentificationServiceInterface;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostInscriptionAction extends AbstractAction {

    private string $template;
    private AuthentificationServiceInterface $catalogue ;

    public function __construct() {
        $this->templateValide = 'TwigPostInscription.twig' ;
        $this->templateInvalide = 'TwigInscription.twig' ;
        $this->catalogue = new AuthentificationService();
    }

    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);

        $parsedBody = $rq->getParsedBody();

        if (!isset($parsedBody['csrf_token'])) {
            throw new Exception('CSRF token missing');
        }

        try {
            CsrfService::check($parsedBody['csrf_token']);
        } catch (Exception $e) {
            throw new Exception('CSRF validation failed: ' . $e->getMessage());
        }

        $email = htmlspecialchars($parsedBody['name'] ?? '');
        $password = password_hash( htmlspecialchars($parsedBody['password'] ?? '') , PASSWORD_BCRYPT);
        if (! filter_var($email , FILTER_VALIDATE_EMAIL)){
            $data = [
                'erreur' => 'Email non conforme !'
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }


        $this->catalogue->addUser($email , $password , 1);

        $_SESSION['email'] = $email;

        return $view->render($rs , $this->templateValide );
    }
}