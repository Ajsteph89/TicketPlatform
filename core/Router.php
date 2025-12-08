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

        // Build proper file path (supports folders)
        $controllerPath = __DIR__ . "/../controllers/" . $controllerName . ".php";

        if (!file_exists($controllerPath)) {
            die("Controller file not found: $controllerPath");
        }

        require_once $controllerPath;

        //  Extract just the class name (no folders)
        $controllerParts = explode('/', $controllerName);
        $className = end($controllerParts);

        if (!class_exists($className)) {
            die("Controller class not found: $className");
        }

        $controller = new $className();
        $controller->$methodName();
    }
}
