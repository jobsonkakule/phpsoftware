<?php
namespace App;

use AltoRouter;
use App\Security\ForbiddenException;

class Router {
    /**
     * @var string
     */
    private $viewPath;

    /**
     * @var AltoRouter
     */
    private $router;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
        $this->router = new AltoRouter();
    }

    public function get(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('GET', $url, $view, $name);
        return $this;
    }

    public function post(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST', $url, $view, $name);
        return $this;
    }
    

    public function match(string $url, string $view, ?string $name = null): self
    {
        $this->router->map('POST|GET', $url, $view, $name);
        return $this;
    }

    public function url(string $name, array $params = [])
    {
        return $this->router->generate($name, $params);
    }

    public function run(): self
    {
        $match = $this->router->match();
        $view = $match['target'] ?: 'e404';
        $params = $match['params'];
        $router = $this;
        $isAdmin = strpos($view, 'admin') !== false;
        $layout = $isAdmin ? 'admin/layouts/default': 'layouts/default';
        ob_start();
        try {
            require $this->viewPath . DIRECTORY_SEPARATOR . $view . '.php';
            $content = ob_get_clean();
            require $this->viewPath . DIRECTORY_SEPARATOR . $layout .'.php';

        } catch (ForbiddenException $e) {
            if (isset($_SESSION['auth'])) {
                header('Location: ' . $this->url('user', ['id' => $_SESSION['auth']]) . '?forbidden=1');
                exit();
            }
            header('Location: ' . $this->url('login') . '?forbidden=1');
            exit();
        }
        
        return $this;
    }
}