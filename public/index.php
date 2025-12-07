<?php
session_start();

// Load core files
require_once __DIR__ . '/../core/Router.php';
require_once __DIR__ . '/../core/Controller.php';

// Load routes
$routes = require_once __DIR__ . '/../config/routes.php';

// Initialize router and dispatch
$router = new Router($routes);
$router->dispatch();
