<?php
require_once __DIR__ . '/../vendor/autoload.php';

// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use App\Controllers\AuthController;
use FastRoute\RouteCollector;
use App\Controllers\HomeController;

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r) {
    // Routes
    $r->addRoute(['GET', 'POST'], '/login', [AuthController::class, 'login']);
    $r->addRoute(['GET', 'POST'], '/register', [AuthController::class, 'register']);
    $r->addRoute('GET', '/logout', [AuthController::class, 'logout']);
    $r->addRoute('GET', '/', [HomeController::class, 'index']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        echo '404 - Page Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        echo '405 - Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $class = $handler[0];
        $method = $handler[1];
        $controller = new $class();
        $controller->$method($vars);
        break;
}