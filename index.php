<?php
require_once __DIR__ . '/Router.php';

$router = new Router();

$router->get('/api/events', __DIR__ . '/api/events.php');
$router->get('/api/competitions', __DIR__ . '/api/competitions.php');
$router->get('/api/sports', __DIR__ . '/api/sports.php');

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

if (str_starts_with($requestUri, '/api/')) {
    $router->run(); 
} else {
    require __DIR__ . '/index.html';
}
