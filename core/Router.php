<?php

class Router
{
    protected $routes = [];

    public function __construct($routes)
    {
        $this->routes = $routes;
    }

    public function dispatch()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $method = $_SERVER['REQUEST_METHOD'];

        // Normalize trailing slash 
        $uri = rtrim($uri, '/') ?: '/';

        if (!isset($this->routes[$method][$uri])) {
            http_response_code(404);
            echo "404 - Page Not Found";
            return;
        }

        $action = $this->routes[$method][$uri];

        [$controllerName, $methodName] = explode('@', $action);

        require_once __DIR__ . "/../controllers/{$controllerName}.php";

        $controller = new $controllerName;
        $controller->$methodName();
    }
}
