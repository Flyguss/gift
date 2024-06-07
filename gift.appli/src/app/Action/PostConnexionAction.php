<?php

namespace gift\appli\app\Action;



use AllowDynamicProperties;
use gift\appli\core\services\CatalogueService;
use gift\appli\core\services\CatalogueServiceInterface;
use gift\appli\core\services\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostConnexionAction extends AbstractAction {

    private string $template;
    private CatalogueServiceInterface $catalogue ;

    public function __construct() {
        $this->templateValide = 'TwigPostConnexion.twig' ;
        $this->templateInvalide = 'TwigConnexion.twig' ;
        $this->catalogue = new CatalogueService();
    }

    /**
     * @throws SyntaxError
     * @throws UserNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response{

        $view = Twig::fromRequest($rq);

        $parsedBody = $rq->getParsedBody();
        $email = htmlspecialchars($parsedBody['name'] ?? '');
        $password = htmlspecialchars($parsedBody['password'] ?? '');
        $user = $this->catalogue->getUserByEmail($email);
        if ($user == null ){
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }

        if (!password_verify($password ,$user->password) ){
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
            ];
            return $view->render($rs , $this->templateInvalide , $data);
        }

        return $view->render($rs , $this->templateValide );
    }
}