<?php

namespace gift\appli\app\Action;

use Exception;
use gift\appli\app\utils\CsrfService;
use gift\appli\core\services\AuthentificationService;
use gift\appli\core\services\AuthentificationServiceInterface;
use gift\appli\core\services\UserNotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PostConnexionAction extends AbstractAction
{

    private string $templateValide;
    private string $templateInvalide;
    private AuthentificationServiceInterface $authentificationService;

    public function __construct()
    {
        $this->templateValide = 'TwigPostConnexion.twig';
        $this->templateInvalide = 'TwigConnexion.twig';
        $this->authentificationService = new AuthentificationService();
    }

    /**
     * @throws SyntaxError
     * @throws UserNotFoundException
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {
        $view = Twig::fromRequest($rq);

        // Récupérer et valider les données du formulaire
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
        $password = $parsedBody['password'] ?? '';


        $user = $this->authentificationService->getUserByEmail($email);
        if ($user == null || !$this->authentificationService->verifyPassword($password, $user)) {
            $data = [
                'erreur' => 'Email ou Mot de passe incorrect !',
            ];
            return $view->render($rs, $this->templateInvalide, $data);
        }

        // Mettre l'email en session
        $_SESSION['email'] = $email;

        return $view->render($rs, $this->templateValide);
    }
}


