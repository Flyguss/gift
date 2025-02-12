<?php

namespace gift\appli\app\Action;

use Exception;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\AuthentificationService;
use gift\appli\core\services\AuthentificationServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class PostInscriptionAction extends AbstractAction {

    private string $template;

    private string $templateValide;
    private string $templateInvalide;
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
        $this->catalogue->addUser($email , $password , 1);
        $user_id = $this->catalogue->getUserByEmail($email)->id;

        if (! filter_var($email , FILTER_VALIDATE_EMAIL)){
            $token = CsrfService::generate();
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
                'token' => $token
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }




        $_SESSION['email'] = $email;
        $_SESSION['user_id'] = $user_id;

        return $view->render($rs , $this->templateValide );
    }
}