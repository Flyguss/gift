<?php

namespace gift\appli\app\Action;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\core\domain\entites\Box;

class GetListCoffretAction extends AbstractAction
{
    public function __invoke(Request $rq, Response $rs, array $args): Response
    {

        $userId = $_SESSION['user_id'] ?? null;

        if($userId != null) {
            $coffrets = Box::with('prestations')->where('createur_id', 'like' ,$userId)->get();
        }else {
            $coffrets = [] ;
        }



        $view = Twig::fromRequest($rq);
        return $view->render($rs, 'TwigListCoffret.twig', ['coffrets' => $coffrets]);
    }
}
