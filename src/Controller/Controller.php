<?php
namespace App\Controller;

use App\Router;
use App\Security\ForbiddenException;

class Controller {

    protected $viewPath;

    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function render ()
    {
        ob_start();
        try {
            require $this->router->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
            $content = ob_get_clean();
            require $this->router->viewPath . DIRECTORY_SEPARATOR . $layout .'.php';

        } catch (ForbiddenException $e) {
            header('Location: ' . $this->router->url('login') . '?forbidden=1');
            exit();
        }
    }
}