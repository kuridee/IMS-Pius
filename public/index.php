<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$app = require_once __DIR__ . '/../bootstrap/app.php';

$routes = require_once __DIR__ . '/../routes/web.php';

$method = $_SERVER['REQUEST_METHOD'];

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri = str_replace('/layered/public', '', $uri);

$uri = $uri ?: '/';


if (isset($routes[$method][$uri])) {

    $routes[$method][$uri]();

    exit;
}


http_response_code(404);

echo "404 - Page Not Found";