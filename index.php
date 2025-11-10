<?php
require_once __DIR__ . '/Router.php';

$router = new Router();

$router->get('/api/countries', __DIR__ . '/api/countries.php');
$router->get('/api/events', __DIR__ . '/api/events.php');
$router->get('/api/competitions', __DIR__ . '/api/competitions.php');

$requestUri = strtok($_SERVER['REQUEST_URI'], '?');

if (str_starts_with($requestUri, '/api/')) {
    $router->run(); 
} else {
    require __DIR__ . '/index.html';
}
